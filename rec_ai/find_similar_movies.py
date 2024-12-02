import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity

def find_similar_movies_combined(csv_path, movie_titles, top_n=5):
    """
    Finds a combined list of movies similar to a list of given movie titles (without requiring the year)
    based on genres using the MovieLens ml-latest dataset.

    Args:
        csv_path (str): Path to the MovieLens `movies.csv` file.
        movie_titles (list): List of movie titles to find similar movies for.
        top_n (int): Number of similar movies to return for each input movie. Default is 5.

    Returns:
        list: A single list of unique similar movies with similarity scores.
    """
    try:
        # Load the dataset
        movies_df = pd.read_csv(csv_path)

        # Debugging: Check the first few rows
        print("Loaded dataset preview:")
        print(movies_df.head())

        # Split titles into "clean_title" and "year" (if available)
        movies_df['clean_title'] = movies_df['title'].str.extract(r'^(.*?)(?: \((\d{4})\))?$')[0].str.strip()

        # Inspect genres before splitting them into lists
        print("\nSample genres (before splitting):")
        print(movies_df['genres'].unique()[:10])

        # Split genres into lists
        movies_df['genres'] = movies_df['genres'].str.split('|')

        # Flatten the list of genres to see unique genres
        unique_genres = set(genre for genres in movies_df['genres'] for genre in genres)

        # Debugging: Check unique genres
        print("\nUnique genres (after splitting):")
        print(unique_genres)

        # One-hot encode genres
        genre_encoding = movies_df['genres'].str.join('|').str.get_dummies()

        # Debugging: Ensure one-hot encoding worked
        print("\nGenre encoding sample:")
        print(genre_encoding.head())

        # Calculate cosine similarity between movies based on genres
        similarity_matrix = cosine_similarity(genre_encoding)

        # Convert similarity matrix to a DataFrame for easier querying
        similarity_df = pd.DataFrame(similarity_matrix, index=movies_df['title'], columns=movies_df['title'])

        # Debugging: Check the similarity matrix
        print("\nSample similarity matrix:")
        print(similarity_df.iloc[:5, :5])

        # Create a set to store unique similar movies
        similar_movies_set = set()

        for input_title in movie_titles:
            # Match input title without requiring the year
            matched_movies = movies_df[movies_df['clean_title'].str.lower() == input_title.lower()]

            if matched_movies.empty:
                # Debugging: Print available titles to help identify issues
                print(f"'{input_title}' not found in the dataset. Available titles include:")
                print(movies_df['clean_title'].unique()[:10])  # Show the first 10 titles as a sample
                continue

            # Use the first match (or extend logic for multiple matches if needed)
            movie_title = matched_movies.iloc[0]['title']

            # Get similarity scores for the matched movie, sort by similarity
            similar_movies = similarity_df[movie_title].sort_values(ascending=False)
            similar_movies = similar_movies[similar_movies.index != movie_title]  # Exclude the movie itself

            # Debugging: Print the top N similar movies
            print(f"\nTop {top_n} similar movies for '{movie_title}':")
            print(similar_movies.head(top_n))

            # Add the top N most similar movies to the set
            similar_movies_set.update(similar_movies.head(top_n).index)

        # Return the combined unique list of movies
        return list(similar_movies_set)

    except Exception as e:
        # Print error details
        print(f"An error occurred: {e}")
        raise

# Main function for running the script
if __name__ == "__main__":
    import argparse

    # Argument parser
    parser = argparse.ArgumentParser(description="Find similar movies using the MovieLens ml-latest dataset.")
    parser.add_argument("csv_path", type=str, help="Path to the MovieLens `movies.csv` file.")
    parser.add_argument("movie_titles", nargs='+', type=str, help="List of movie titles to find similar movies for.")
    parser.add_argument("--top_n", type=int, default=5, help="Number of similar movies to return for each input movie.")

    args = parser.parse_args()

    # Call the function
    combined_movies = find_similar_movies_combined(args.csv_path, args.movie_titles, args.top_n)

    # Output the results
    print("\nCombined list of movies similar to the input movies:")
    for movie in combined_movies:
        print(movie)
