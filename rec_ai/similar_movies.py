import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity

# Load MovieLens dataset
movies_path = "ml-latest-small/movies.csv"  # Adjust path if needed
movies_df = pd.read_csv(movies_path)

# Display first rows to understand the structure (optional)
print(movies_df.head())

# Extract movie titles and genres
movies_df = movies_df[['movieId', 'title', 'genres']]

# Handle genres: split into a list of genres
movies_df['genres'] = movies_df['genres'].str.split('|')

# One-hot encode genres
genre_encoding = movies_df['genres'].str.join('|').str.get_dummies()

# Calculate cosine similarity between movies based on genres
similarity_matrix = cosine_similarity(genre_encoding)

# Convert similarity matrix to a DataFrame for easier querying
similarity_df = pd.DataFrame(similarity_matrix, index=movies_df['title'], columns=movies_df['title'])

# Function to find similar movies
def get_similar_movies(movie_title, top_n=5):
    if movie_title not in similarity_df:
        return f"'{movie_title}' not found in the dataset."
    
    # Get similarity scores for the given movie, sort by similarity
    similar_movies = similarity_df[movie_title].sort_values(ascending=False)
    similar_movies = similar_movies[similar_movies.index != movie_title]  # Exclude the movie itself

    # Return the top N most similar movies
    return similar_movies.head(top_n)

# Input: Movie title
#movie_input = input("Enter a movie title: ")
movie_input = "Toy Story (1995)"

# Output: Similar movies
top_movies = get_similar_movies(movie_input, top_n=5)

if isinstance(top_movies, str):  # Handle errors
    print(top_movies)
else:
    print(f"\nMovies similar to '{movie_input}':")
    for title, score in top_movies.items():
        print(f"{title} (Similarity: {score:.2f})")