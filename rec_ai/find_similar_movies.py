import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity

def find_similar_movies_combined(movies_path, movie_titles, top_n=5):
    """
    Finds a combined list of movies similar to a list of given movie titles based on genres using the MovieLens dataset.

    Args:
        movies_path (str): Path to the MovieLens `movies.csv` file.
        movie_titles (list): List of movie titles to find similar movies for.
        top_n (int): Number of similar movies to return for each input movie. Default is 5.

    Returns:
        list: A single list of unique similar movies with similarity scores.
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

        # Create a set to store unique similar movies
        similar_movies_set = set()

        for movie_title in movie_titles:
            # Check if the movie title exists in the dataset
            if movie_title not in similarity_df:
                print(f"'{movie_title}' not found in the dataset.")
                continue

            # Get similarity scores for the given movie, sort by similarity
            similar_movies = similarity_df[movie_title].sort_values(ascending=False)
            similar_movies = similar_movies[similar_movies.index != movie_title]  # Exclude the movie itself

            # Add the top N most similar movies to the set
            similar_movies_set.update(similar_movies.head(top_n).index)

        # Return the combined unique list of movies
        return list(similar_movies_set)

    except Exception as e:
        return {"error": f"An error occurred: {str(e)}"}

# Main function for running the script
if __name__ == "__main__":
    import argparse

    # Argument parser
    parser = argparse.ArgumentParser(description="Find similar movies using the MovieLens dataset.")
    parser.add_argument("movies_path", type=str, help="Path to the MovieLens `movies.csv` file.")
    parser.add_argument("movie_titles", nargs='+', type=str, help="List of movie titles to find similar movies for.")
    parser.add_argument("--top_n", type=int, default=5, help="Number of similar movies to return for each input movie.")

    args = parser.parse_args()

    # Call the function
    combined_movies = find_similar_movies_combined(args.movies_path, args.movie_titles, args.top_n)

    # Output the results
    print("\nCombined list of movies similar to the input movies:")
    for movie in combined_movies:
        print(movie)