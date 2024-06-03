let date  = new Date().toISOString().slice(0, 10);
let username = document.getElementById("username").textContent;


const percentageElement = document.querySelector(".percentage");
const calorieBudgetElement = document.getElementById("totalCalorieText")
const calorieLeftElement = document.getElementById("total-calorie-left-text")
let calorieBudget = 2700;
let totalCalories = 0;
percent = totalCalories / calorieBudget * 100;
percentageElement.dataset.percent = percent; 
percentageElement.innerText = totalCalories + " Calories Consumed"; 

const circleElement = document.querySelector("#circle");
string = "linear-gradient(#e4e4e4, #e4e4e4), linear-gradient(180deg, #e4e4e4 "+ (100-percent) + "%, black 0%)";
circleElement.style.backgroundImage = string;

const mealBoxElements = document.querySelectorAll(".meal-box");
const popupElement = document.getElementById("mealPopup");
const mealPopupCloseButton = document.getElementById("mealPopupCloseButton");

let breakfastList = {};
let lunchList = {};
let dinnerList = {};
let snackList = {};

let breakfastCalories = 0;
let lunchCalories = 0;
let dinnerCalories = 0;
let snackCalories = 0;

let breakfastProtein = 0;
let lunchProtein = 0;
let dinnerProtein = 0;
let snackProtein = 0;

let breakfastCarbs = 0;
let lunchCarbs = 0;
let dinnerCarbs = 0;
let snackCarbs = 0;

let breakfastFat = 0;
let lunchFat = 0;
let dinnerFat = 0;
let snackFat = 0;

let breakfastFiber = 0;
let lunchFiber = 0;
let dinnerFiber = 0;
let snackFiber = 0;

let meal = "";

const breakfastCaloriesElement = document.getElementById("breakfast-calories");
const lunchCaloriesElement = document.getElementById("lunch-calories");
const dinnerCaloriesElement = document.getElementById("dinner-calories");
const snackCaloriesElement = document.getElementById("snacks-calories");

let protein = 0;
let carbs = 0;
let fat = 0;
let fiber = 0;

getCalorieData(username);
// updateTotalCaloriesDatabase(calorieBudget);
getMealData(username, date);

const calorieEntryElement = document.getElementById('total-calorie-entry');
calorieEntryElement.addEventListener('click', () => {
    document.getElementById('calorieBudgetPopup').style.display = 'block';
    document.getElementById('calorieBudgetInput').value = calorieBudget;
});

// Close popup
const calorieBudgetPopupCloseButton = document.getElementById('calorieBudgetPopupCloseButton');
calorieBudgetPopupCloseButton.addEventListener('click', () => {
    document.getElementById('calorieBudgetPopup').style.display = 'none';
});

const updateCalorieBudgetButton = document.getElementById('updateCalorieBudgetButton');
updateCalorieBudgetButton.addEventListener('click', () => {
    const newCalorieBudget = document.getElementById('calorieBudgetInput').value;
    if (newCalorieBudget > 0) {
        updateCalories(newCalorieBudget);
        document.getElementById('calorieBudgetPopup').style.display = 'none';
    } else {
        alert('Please enter a valid calorie budget');
    }
});

function updateCalories(calories) {
  calorieBudget = calories;
  calorieBudgetElement.innerText = "Calorie Budget: " + calorieBudget;
  calorieLeftElement.innerText = calorieBudget - totalCalories;
  // 2700 / 2700 Calories Left
  updateTotalCaloriesDatabase(calorieBudget);
  updateAll(); // Update all calculations based on the new budget
}

mealBoxElements.forEach((mealBox) => {
  mealBox.addEventListener("click", () => {

    if (mealBox.id == "breakfast") {
      meal = "breakfast"
      clearSearch();
    }
    else if (mealBox.id == "lunch") {
      meal = "lunch"
      clearSearch();
    }
    else if (mealBox.id == "dinner") {
      meal = "dinner"
      clearSearch();
    }
    else if (mealBox.id == "snacks") {
      meal = "snacks"
      clearSearch();
    }
        
    displayMealListContents(meal);
    popupElement.style.display = "block";
    
  });

});

function displayMealListContents(meal) {
  if (meal == "breakfast") {
    mealList = breakfastList;
  } else if (meal == "lunch") {
    mealList = lunchList;
  } else if (meal == "dinner") {
    mealList = dinnerList;
  } else if (meal == "snacks") {
    mealList = snackList;
  }

  const searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = '';

  if (Object.keys(mealList).length == 0) {
    return;
  } else {

    Object.values(mealList).forEach((food, index) => {

      if (food[1] != 0) {

        const resultItem = document.createElement('div');

        resultItem.classList = 'resultItem'
        resultItem.id = index
        resultItem.title = food[0].description

        const button = document.createElement('input');
        button.type = "number";
        button.min = 0;

        resultItem.textContent = food[0].description;
        searchResults.appendChild(resultItem);
        resultItem.appendChild(button);

        button.value = food[1];

        button.onclick = function() {

          consumedAmount = parseInt(button.value);

          if (meal == "breakfast") {
            addBreakfast(food[0], consumedAmount);
          } else if (meal == "lunch") {
            addLunch(food[0], consumedAmount);
          } else if (meal == "dinner") {
            addDinner(food[0], consumedAmount);
          } else if (meal == "snacks") {
            addSnack(food[0], consumedAmount);
          }
          updateMealTracker(username, breakfastList, lunchList, dinnerList, snackList, date);
        }

        button.addEventListener('keyup', (event) => {
          if (event.key) {

            consumedAmount = parseInt(button.value);

            if (meal == "breakfast") {
              addBreakfast(food[0], consumedAmount);
            } else if (meal == "lunch") {
              addLunch(food[0], consumedAmount);
            } else if (meal == "dinner") {
              addDinner(food[0], consumedAmount);
            } else if (meal == "snacks") {
              addSnack(food[0], consumedAmount);
            }
            updateMealTracker(username, breakfastList, lunchList, dinnerList, snackList, date);
          }
        })

        const foodCalories = document.createElement('div');
        foodCalories.classList = 'foodCalories';

        for (let i = 0; i < food[0].foodNutrients.length; i++) {
          if (food[0].foodNutrients[i]["nutrientNumber"] == "208") {
            foodCalories.textContent = food[0].foodNutrients[i]["value"] + " cal";
            resultItem.appendChild(foodCalories);
          }
        }
          
        }

    });
  }
}

function clearSearch() {
  const searchInput = document.getElementById('searchInput');
  searchInput.value = '';
  const searchResults = document.getElementById('searchResults');
  searchResults.innerHTML = '';
}

popupElement.addEventListener("click", (e) => {
  if (e.target === popupElement) {
    popupElement.style.display = "none";
  }
});

mealPopupCloseButton.addEventListener("click", (e) => {
  if (e.target === mealPopupCloseButton) {

    popupElement.style.display = "none";
  }
});


// API
const searchInput = document.getElementById('searchInput');
const apiEndpoint = 'https://api.nal.usda.gov/fdc/v1/foods/search';
const apiKey = 'VDyFzoJp07mAejenLW39YulDwivBiNJVc3Ue1Udr';
// const apiKey = 'DEMO_KEY';

searchInput.addEventListener('keyup', (event) => {
  if (event.key) {
    const query = searchInput.value;

    const params = new URLSearchParams({
      query: query,
      dataType: '',
      pageSize: 10,
      pageNumber: 1,
      sortBy: 'dataType.keyword',
      sortOrder: 'asc',
      nutrients: 203,
      api_key: apiKey,
    });

    const apiUrl = `${apiEndpoint}?${params.toString()}`;

    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => {
        const searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '';
        
        data.foods.forEach((food, index) => {
          if (index < 10) {
            const resultItem = document.createElement('div');

            resultItem.classList = 'resultItem'
            resultItem.id = index
            resultItem.title = food.description

            const button = document.createElement('input');
            button.type = "number";
            button.min = 0;

            resultItem.textContent = food.description;
            searchResults.appendChild(resultItem);
            resultItem.appendChild(button);

            if (meal == "breakfast") {
              if (Object.keys(breakfastList).includes(String(food["fdcId"]))) {
                button.value = breakfastList[food["fdcId"]][1];
              }
            } else if (meal == "lunch") {
              if (Object.keys(lunchList).includes(String(food["fdcId"]))) {
                button.value = lunchList[food["fdcId"]][1];
              }
            } else if (meal == "dinner") {
              if (Object.keys(dinnerList).includes(String(food["fdcId"]))) {
                button.value = dinnerList[food["fdcId"]][1];
              }
            } else if (meal == "snacks") {
              if (Object.keys(snackList).includes(String(food["fdcId"]))) {
                button.value = snackList[food["fdcId"]][1];
              }
            }

            button.onclick = function() {

              consumedAmount = parseInt(button.value);

              if (meal == "breakfast") {
                addBreakfast(food, consumedAmount);
              } else if (meal == "lunch") {
                addLunch(food, consumedAmount);
              } else if (meal == "dinner") {
                addDinner(food, consumedAmount);
              } else if (meal == "snacks") {
                addSnack(food, consumedAmount);
              }
              updateMealTracker(username, breakfastList, lunchList, dinnerList, snackList, date);
            }

            button.addEventListener('keyup', (event) => {
              if (event.key) {

                consumedAmount = parseInt(button.value);

                if (meal == "breakfast") {
                  addBreakfast(food, consumedAmount);
                } else if (meal == "lunch") {
                  addLunch(food, consumedAmount);
                } else if (meal == "dinner") {
                  addDinner(food, consumedAmount);
                } else if (meal == "snacks") {
                  addSnack(food, consumedAmount);
                }
                updateMealTracker(username, breakfastList, lunchList, dinnerList, snackList, date);
              }

            })

            const foodCalories = document.createElement('div');
            foodCalories.classList = 'foodCalories';

            for (let i = 0; i < food.foodNutrients.length; i++) {
              if (food.foodNutrients[i]["nutrientNumber"] == "208") {
                foodCalories.textContent = food.foodNutrients[i]["value"] + " cal";
                resultItem.appendChild(foodCalories);
              }
            }
          }
        });
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
});

function addBreakfast(food, amount) {

  breakfastCalories = 0;
  breakfastProtein = 0;
  breakfastCarbs = 0;
  breakfastFat = 0;
  breakfastFiber = 0;

  if (amount >= 0) {
    breakfastList[food["fdcId"]] = [food, amount];
  }

  for (item in breakfastList) {
    food = breakfastList[item][0];
    consumedAmount = breakfastList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        breakfastProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        breakfastFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        breakfastCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        breakfastFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        breakfastCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        breakfastCaloriesElement.textContent = breakfastCalories;
      }
    }
  }

  if (amount == 0) {
    delete breakfastList[food["fdcId"]];
  }

  updateAll();
}

function updateBreakfast() {

  breakfastCalories = 0;
  breakfastProtein = 0;
  breakfastCarbs = 0;
  breakfastFat = 0;
  breakfastFiber = 0;

  for (item in breakfastList) {
    food = breakfastList[item][0];
    consumedAmount = breakfastList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        breakfastProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        breakfastFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        breakfastCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        breakfastFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        breakfastCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        breakfastCaloriesElement.textContent = breakfastCalories;
      }
    }
  }

  updateAll();
}

function addLunch(food, amount) {

  lunchCalories = 0;
  lunchProtein = 0;
  lunchCarbs = 0;
  lunchFat = 0;
  lunchFiber = 0;

  if (amount >= 0) {
    lunchList[food["fdcId"]] = [food, amount];
  }

  for (item in lunchList) {
    food = lunchList[item][0];
    consumedAmount = lunchList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        lunchProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        lunchFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        lunchCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        lunchFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        lunchCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        lunchCaloriesElement.textContent = lunchCalories;
      }
    }
  }

  if (amount == 0) {
    delete lunchList[food["fdcId"]];
  }

  updateAll();
}

function updateLunch() {

  lunchCalories = 0;
  lunchProtein = 0;
  lunchCarbs = 0;
  lunchFat = 0;
  lunchFiber = 0;

  for (item in lunchList) {
    food = lunchList[item][0];
    consumedAmount = lunchList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        lunchProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        lunchFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        lunchCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        lunchFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        lunchCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        lunchCaloriesElement.textContent = lunchCalories;
      }
    }
  }
  updateAll();
}

function addDinner(food, amount) {

  dinnerCalories = 0;
  dinnerProtein = 0;
  dinnerCarbs = 0;
  dinnerFat = 0;
  dinnerFiber = 0;

  if (amount >= 0) {
    dinnerList[food["fdcId"]] = [food, amount];
  }

  for (item in dinnerList) {
    food = dinnerList[item][0];
    consumedAmount = dinnerList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        dinnerProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        dinnerFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        dinnerCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        dinnerFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        dinnerCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        dinnerCaloriesElement.textContent = dinnerCalories;
      }
    }
  }

  if (amount == 0) {
    delete dinnerList[food["fdcId"]];
  }

  updateAll();
}

function updateDinner() {

  dinnerCalories = 0;
  dinnerProtein = 0;
  dinnerCarbs = 0;
  dinnerFat = 0;
  dinnerFiber = 0;

  for (item in dinnerList) {
    food = dinnerList[item][0];
    consumedAmount = dinnerList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        dinnerProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        dinnerFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        dinnerCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        dinnerFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        dinnerCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        dinnerCaloriesElement.textContent = dinnerCalories;
      }
    }
  }
  updateAll();
}

function addSnack(food, amount) {

  snackCalories = 0;  
  snackProtein = 0;
  snackCarbs = 0;
  snackFat = 0;
  snackFiber = 0;

  if (amount >= 0) {
    snackList[food["fdcId"]] = [food, amount];
  }

  for (item in snackList) {
    food = snackList[item][0];
    consumedAmount = snackList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        snackProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        snackFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        snackCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        snackFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        snackCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        snackCaloriesElement.textContent = snackCalories;
      }
    }
  }

  if (amount == 0) {
    delete snackList[food["fdcId"]];
  }

  updateAll();
}

function updateSnack() {
  snackCalories = 0;  
  snackProtein = 0;
  snackCarbs = 0;
  snackFat = 0;
  snackFiber = 0;

  for (item in snackList) {
    food = snackList[item][0];
    consumedAmount = snackList[item][1];

    for (let i = 0; i < food.foodNutrients.length; i++) {
      if (food.foodNutrients[i]["nutrientNumber"] == "203") {
        snackProtein += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      } 
      
      else if (food.foodNutrients[i]["nutrientNumber"] == "204") {
        snackFat +=(parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "205") {
        snackCarbs += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "291") {
        snackFiber += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
      }

      else if (food.foodNutrients[i]["nutrientNumber"] == "208") {
        snackCalories += (parseInt(food.foodNutrients[i]["value"]) * consumedAmount);
        snackCaloriesElement.textContent = snackCalories;
      }
    }
  }
  updateAll();
}

function updateTotalCalories() {
  totalCalories = breakfastCalories + lunchCalories + dinnerCalories + snackCalories;

  percent = totalCalories / calorieBudget * 100;

  percentageElement.dataset.percent = percent; 
  percentageElement.innerText = totalCalories + " Calories Consumed"; 

  string = "linear-gradient(#e4e4e4, #e4e4e4), linear-gradient(180deg, #e4e4e4 "+ (100-percent) + "%, black 0%)";
  circleElement.style.backgroundImage = string;
  calorieBudgetElement.innerText = "Calorie Budget: " + calorieBudget;
  calorieLeftElement.innerText = calorieBudget - totalCalories
}

function updateTotalProtein() {
  protein = breakfastProtein + lunchProtein + dinnerProtein + snackProtein;
  proteinElement = document.getElementById("protein-amount");
  proteinElement.textContent = protein;
}

function updateTotalCarbs() {
  carbs = breakfastCarbs + lunchCarbs + dinnerCarbs + snackCarbs;
  carbsElement = document.getElementById("carbs-amount");
  carbsElement.textContent = carbs;
}

function updateTotalFat() {
  fat = breakfastFat + lunchFat + dinnerFat + snackFat;
  fatElement = document.getElementById("fat-amount");
  fatElement.textContent = fat;
}

function updateTotalFiber() {
  fiber = breakfastFiber + lunchFiber + dinnerFiber + snackFiber;
  fiberElement = document.getElementById("fiber-amount");
  fiberElement.textContent = fiber;
}

function updateAll() {
  updateTotalCalories();
  updateTotalProtein();
  updateTotalCarbs();
  updateTotalFat();
  updateTotalFiber();
  
}

function updateTotalCaloriesDatabase(calories) {

  let Data = new FormData();

  Data.append('username', username);
  Data.append('calories', calories);

  fetch('calorie-tracker-update-calories.php', {
    method: 'POST', 
    body: Data
  })
  .then(response => console.log(response))
  .catch(error => {
    console.error('Error:', error);
  });
}

function getCalorieData(username) {

  let Data = new FormData();

  Data.append('username', username);

  fetch('calorie-tracker-get-calorie.php', {
    method: 'POST', 
    body: Data
  })
  .then(response => response.json())
  .then(data => {
    
    if (data["calories"] != null) {
      calories = JSON.parse(data["calories"]);
      calorieBudget = parseInt(calories);
      updateCalories(parseInt(calories));

    }
    
  })
  .catch(error => console.log('Error loading PHP script:', error));
}

function updateMealTracker(username, breakfastList, lunchList, dinnerList, snackList, date) {

  let Data = new FormData();

  Data.append('username', username);
  Data.append('breakfastList', JSON.stringify(breakfastList));
  Data.append('lunchList', JSON.stringify(lunchList));
  Data.append('dinnerList', JSON.stringify(dinnerList));
  Data.append('snackList', JSON.stringify(snackList));
  Data.append('date', date);

  fetch('calorie-tracker-update-data.php', {
    method: 'POST', 
    body: Data
  })
  .then(response => console.log(response))
  .catch(error => {
    console.error('Error:', error);
  });
}

function getMealData(username, date) {
  // date = "2023-11-08";

  let Data = new FormData();

  Data.append('username', username);
  Data.append('date', date);

  fetch('calorie-tracker-get-data.php', {
    method: 'POST', 
    body: Data
  })
  .then(response => response.json())
  .then(data => {

    if (data["breakfastList"] != null) {
      breakfastList = JSON.parse(data["breakfastList"]);
    }

    if (data["lunchList"] != null) {
      lunchList = JSON.parse(data["lunchList"]);
    }

    if (data["dinnerList"] != null) {
      dinnerList = JSON.parse(data["dinnerList"]);
    }

    if (data["snackList"] != null) {
      snackList = JSON.parse(data["snackList"]);
    }

    updateBreakfast();
    updateLunch();
    updateDinner();
    updateSnack();
    updateAll();
  })
  .catch(error => console.log('Error loading PHP script:', error));
}