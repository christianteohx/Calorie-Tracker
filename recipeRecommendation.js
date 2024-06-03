const recipeElements = document.querySelectorAll(".recipeItem");
const apiKey = "f446574b772a4017912ac00338169e9a";

recipeElements.forEach((recipeItems) => {
    recipeItems.addEventListener("click", () => {
        recipeId = recipeItems.id
        // fetchRecipeDetails(recipeId)

        const apiUrl = `https://api.spoonacular.com/recipes/${recipeId}/information?apiKey=${apiKey}`;
        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
                sentID(data.id)
            })
            .catch((error) => {
                console.error("Error fetching recipe:", error);
            });

    })
})

function sentID(id) {
    //console.log(id)
    // const recipeId = element.parentElement.id;
    const message = {
        id: id,
    }

    console.log(message["id"]);
    window.postMessage(message, '/recipe.html');
}

function displayRecipeDetails(recipe) {
    console.log("WORKING")
    const recipeTitle = document.querySelector(".recipeTitle");
    const recipeImage = document.querySelector(".recipeImage");
    const recipeInstructions = document.querySelector(".recipeInstructions");

    const title = document.getElementsByClassName("title")
    title.innerHTML = recipe.title



    recipeTitle.textContent = recipe.title;
    recipeImage.src = recipe.image;
    recipeInstructions.innerHTML = recipe.instructions;
}


const recipeItemElement = document.querySelectorAll(".recipeItem");

recipeItemElement.forEach((recipeItem) => {
    recipeItem.addEventListener("click", () => {
        console.log("getrecipe1")
        getRecipe()
    })
})

function getRecipe() {
    console.log("getrecipe2")
    const urlParams = new URLSearchParams(window.location.search);
    const recipeId = urlParams.get("recipeId");

    if (recipeId) {
        fetchRecipeDetails(recipeId);
    }
}


//sorting feature

function filterRecipes() {
    let input = document.getElementById('searchInput');
    let filterText = input.value.toUpperCase();
    const recipeSections = document.querySelectorAll('.recipeBox');

    recipeSections.forEach(section => {
        let recipes = section.getElementsByClassName('recipeItem');

        for (let i = 0; i < recipes.length; i++) {
            let titleElement = recipes[i].querySelector('h2 a') || recipes[i].querySelector('h2');
            if (titleElement) {
                let titleText = titleElement.textContent || titleElement.innerText;
                recipes[i].style.display = titleText.toUpperCase().indexOf(filterText) > -1 ? "" : "none";
            }
        }
    });
}


function sortRecipes(sortBy) {
    const recipeSections = document.querySelectorAll('.recipeBox');

    recipeSections.forEach(section => {
        let recipes = Array.from(section.getElementsByClassName('recipeItem'));

        switch(sortBy) {
            case 'calories-asc':
                recipes.sort((a, b) => getCalories(a) - getCalories(b));
                break;
            case 'calories-desc':
                recipes.sort((a, b) => getCalories(b) - getCalories(a));
                break;
            case 'text-asc':
                recipes.sort((a, b) => getText(a).localeCompare(getText(b)));
                break;
            case 'text-desc':
                recipes.sort((a, b) => getText(b).localeCompare(getText(a)));
                break;
        }

        recipes.forEach(recipe => {
            section.appendChild(recipe);
        });
    });
}

function getCalories(element) {
    return parseInt(element.querySelector('.calories').textContent.replace(' Calories', ''));
}

function getText(element) {
    return element.querySelector('h2 a').textContent.trim().toUpperCase();
}

//sprint4

// document.getElementById('recipeForm').addEventListener('submit', function(e) {
//     e.preventDefault();

//     const recipeData = {
//         title: document.getElementById('recipeTitle').value,
//         ingredients: document.getElementById('recipeIngredients').value,
//         instructions: document.getElementById('recipeInstructions').value,
//         calories: document.getElementById('recipeCalories').value,
//     };

//     let recipes = JSON.parse(localStorage.getItem('userRecipes')) || [];
//     recipes.push(recipeData);
//     localStorage.setItem('userRecipes', JSON.stringify(recipes));

//     addRecipeToUI(recipeData, recipes.length - 1);
//     document.getElementById('recipeForm').reset();
// });

// document.addEventListener('DOMContentLoaded', function() {
//     let storedRecipes = JSON.parse(localStorage.getItem('userRecipes'));
//     if (storedRecipes) {
//         storedRecipes.forEach((recipe, index) => {
//             addRecipeToUI(recipe, index);
//         });
//     }
// });

function addRecipeToUI(recipe) {
    const container = document.getElementById('userRecipesContainer');
    const recipeElement = document.createElement('div');
    recipeElement.classList.add('recipeItem');

    recipeElement.innerHTML = `
        <h2>${recipe.title}</h2>
        <p class="scrollable-content">Ingredients: ${recipe.ingredients}</p>
        <p class="scrollable-content">Instructions: ${recipe.instructions}</p>
        <p class="calories">${recipe.calories} Calories</p>
    `;

    
    // const deleteButton = document.createElement('button');
    // deleteButton.textContent = 'X';
    // deleteButton.classList.add('deleteButton');
    // deleteButton.onclick = function() { deleteRecipe(index); };
    // recipeElement.appendChild(deleteButton);

    container.appendChild(recipeElement);
}

function deleteRecipe(index) {
    let recipes = JSON.parse(localStorage.getItem('userRecipes')) || [];
    recipes.splice(index, 1);
    localStorage.setItem('userRecipes', JSON.stringify(recipes));

    document.getElementById('userRecipesContainer').innerHTML = '';
    recipes.forEach((recipe, newIndex) => {
        addRecipeToUI(recipe, newIndex);
    });
}

function showNotification(message, isSuccess) {
    notification.textContent = message;
    notification.style.backgroundColor = isSuccess ? "#4CAF50" : "#F44336";
    notification.style.display = "block";
  
    setTimeout(() => {
      notification.style.display = "none";
    }, 3000);
}

function sendMessageToServer(user) {

    if(user == 'Guest'){
        showNotification("please log in to add recipes",false);
        return;
    }
    //user,recipeTitle,recipeIngredients,recipeInstructions,recipeCalories
    recipeTitle = document.getElementById("recipeTitle").value;
    recipeIngredients = document.getElementById("recipeIngredients").value;
    recipeInstructions = document.getElementById("recipeInstructions").value;
    recipeCalories = document.getElementById("recipeCalories").value;



    const recipeData = {
        title: recipeTitle,
        ingredients: recipeIngredients,
        instructions: recipeInstructions,
        calories: recipeCalories,
    };

    let Data = new FormData();

    Data.append('user', user);
    Data.append('recipeTitle', recipeTitle);
    Data.append('recipeIngredients', recipeIngredients);
    Data.append('recipeInstructions', recipeInstructions);
    Data.append('recipeCalories', recipeCalories);

    fetch('saveRecipes.php', {
        method: 'POST', 
        body: Data
    })

    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json(); 
    })
    .then(data => {
        console.log(data); 
        if (data.status === 'success') {
            showNotification(data.message,true);
            addRecipeToUI(recipeData);
        } else {
            showNotification(data.message,false);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error:',false);
    });

}



function recipeHistory(user) {

    if(user == "Guest"){
        return;
    }

    let Data = new FormData();

    Data.append('user', user); 

    fetch('getRecipeHistory.php', {
        method: 'POST', 
        body: Data
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(recipe => {
            const recipeData = {
                title: recipe.recipeTitle,
                ingredients: recipe.Ingredients,
                instructions: recipe.Instructions,
                calories: recipe.Calories,
            };
        
            addRecipeToUI(recipeData);
        });
    })
}

