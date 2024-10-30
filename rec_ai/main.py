from fastapi import FastAPI
from pydantic import BaseModel

app = FastAPI()

# Define a Pydantic model for the expected POST data
class User(BaseModel):
    name: str
    age: int

@app.post("/users")
async def create_user(user: User):
    return {"message": f"User {user.name} of age {user.age} created successfully"}

# New GET route for retrieving user data
@app.get("/users")
async def get_user():
    # Return example data for testing
    return {"name": "Alice", "age": 30}