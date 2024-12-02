import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity

def find_similar_movies(movies_path, movie_title, top_n=5):
    """
    Finds movies similar to the given movie title based on genres using the MovieLens dataset.

    Args:
        movies_path (str): Path to the MovieLens `movies.csv` file.
        movie_title (str): Title of the movie to find similar movies for.
        top_n (int): Number of similar movies to return. Default is 5.

    Returns:
        str: A message or a list of similar movies with similarity scores.
    """
    try:
        # Load MovieLens dataset
        movies_df = pd.read_csv(movies_path)

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

        # Check if the movie title exists in the dataset
        if movie_title not in similarity_df:
            return f"'{movie_title}' not found in the dataset."

        # Get similarity scores for the given movie, sort by similarity
        similar_movies = similarity_df[movie_title].sort_values(ascending=False)
        similar_movies = similar_movies[similar_movies.index != movie_title]  # Exclude the movie itself

        # Return the top N most similar movies
        result = similar_movies.head(top_n)
        return [(title, round(score, 2)) for title, score in result.items()]

    except Exception as e:
        return f"An error occurred: {str(e)}"

# Example usage in another file:
# from this_file import find_similar_movies
# similar = find_similar_movies("ml-latest-small/movies.csv", "Toy Story (1995)", top_n=5)
# print(similar)