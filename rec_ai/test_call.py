from movie_similarity import find_similar_movies

# Call the function with the MovieLens dataset and a specific movie title
movies_path = "ml-latest-small/movies.csv"
movie_title = "Toy Story (1995)"
top_n = 5

similar_movies = find_similar_movies(movies_path, movie_title, top_n)

if isinstance(similar_movies, str):  # Handle error messages
    print(similar_movies)
else:
    print(f"Movies similar to '{movie_title}':")
    for title, score in similar_movies:
        print(f"{title} (Similarity: {score})")