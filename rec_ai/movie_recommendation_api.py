from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List
import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity

"""
Example API Calls:

POST
http://127.0.0.1:8001/set-movies/
{ "movies": ["Toy Story", "Clueless"] }

GET
http://127.0.0.1:8001/get-recommendations/?top_n=5
"""

app = FastAPI()

# Global storage for movies and dataset path
user_movie_list = []
dataset_path = "ml-latest-small/movies.csv"  # Update with the correct path to the MovieLens dataset

# Pydantic model for request payload
class MovieList(BaseModel):
    movies: List[str]

def load_movie_data(csv_path):
    """
    Load and preprocess the movie dataset for recommendation.
    """
    try:
        # Load the dataset
        movies_df = pd.read_csv(csv_path)

        # Extract clean titles and genres
        movies_df['clean_title'] = movies_df['title'].str.extract(r'^(.*?)(?: \((\d{4})\))?$')[0].str.strip()
        movies_df['genres'] = movies_df['genres'].str.split('|')

        # One-hot encode genres
        genre_encoding = movies_df['genres'].str.join('|').str.get_dummies()

        # Calculate similarity matrix
        similarity_matrix = cosine_similarity(genre_encoding)
        similarity_df = pd.DataFrame(similarity_matrix, index=movies_df['title'], columns=movies_df['title'])

        return movies_df, similarity_df
    except Exception as e:
        raise RuntimeError(f"Error loading movie data: {e}")

@app.on_event("startup")
def setup():
    """
    Load the movie dataset and similarity matrix on startup.
    """
    global movies_df, similarity_df
    try:
        movies_df, similarity_df = load_movie_data(dataset_path)
    except RuntimeError as e:
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/set-movies/")
def set_movies(movie_list: MovieList):
    """
    Endpoint to set the user's list of favorite movies.
    """
    global user_movie_list
    user_movie_list = movie_list.movies
    return {"message": "Movies list updated successfully.", "movies": user_movie_list}

@app.get("/get-recommendations/")
def get_recommendations(top_n: int = 5):
    """
    Endpoint to get recommendations based on the set movie list.
    """
    if not user_movie_list:
        raise HTTPException(status_code=400, detail="Movie list is empty. Use /set-movies/ to add movies.")

    global movies_df, similarity_df
    similar_movies_set = set()

    for input_title in user_movie_list:
        # Match input title without requiring the year
        matched_movies = movies_df[movies_df['clean_title'].str.lower() == input_title.lower()]

        if matched_movies.empty:
            continue

        # Use the first match
        movie_title = matched_movies.iloc[0]['title']

        # Get similarity scores for the matched movie
        similar_movies = similarity_df[movie_title].sort_values(ascending=False)
        similar_movies = similar_movies[similar_movies.index != movie_title]

        # Add the top N most similar movies
        similar_movies_set.update(similar_movies.head(top_n).index)
        

    return {"recommendations": list(similar_movies_set)}
