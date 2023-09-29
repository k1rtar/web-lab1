 // Только один чекбокс X в активном положении
  const checkboxes = document.querySelectorAll('.custom-checkbox');

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
      checkboxes.forEach((otherCheckbox) => {
        if (otherCheckbox !== checkbox) {
          otherCheckbox.checked = false;
        }
      });
    });
  });


    // Обработчик клика по кнопкам R
    const rButtons = document.querySelectorAll('.r-button');
    const selectedRInput = document.getElementById('selected-r');
  
    rButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const rValue = button.value;
        selectedRInput.value = rValue;
      });
    });

document.addEventListener("DOMContentLoaded", function () {
  
  const savedResultsData = localStorage.getItem("savedData");

  if (savedResultsData) {
    document.getElementsByClassName("results-table")[0].innerHTML = savedResultsData;}
});





  const submitButton = document.getElementById("submit-button");
  submitButton.addEventListener("click", function (e) {
    e.preventDefault();

    const xInputs = document.querySelectorAll('input[name="x"]:checked');
    const yInput = document.getElementById("y-input").value;
    const rInput = document.getElementById("selected-r").value;
    const errorMessagesElement = document.getElementById("error-message");

    errorMessagesElement.textContent = "";

    const errors = [];

    if (xInputs.length === 0) {
      errors.push("Выберите значение X.");
    }

    const yRegex = /^-?(\d+(\.\d+)?|[0-2](\.\d+)?)$/;
    const numericY = parseFloat(yInput);
    if (!yRegex.test(yInput) || isNaN(numericY) || numericY <= -3 || numericY >= 3) {
      errors.push("Введите корректное числовое значение Y в диапазоне (-3;3).");
     
    }

    if (rInput === "#") {
      errors.push("Выберите значение R.");
    }

    if (errors.length > 0) {
      const errorMessageHTML = errors.map(error => `<p>${error}</p>`).join("");
      errorMessagesElement.innerHTML = errorMessageHTML;
    } else {

      const url = `php/server.php?x=${xInputs[0].value}&y=${yInput}&r=${rInput}`;

      // Выполняем AJAX-запрос методом GET
      fetch(url)
        .then((response) => response.text())
        .then((data) => {
          // Обновляем результаты на странице
          document.getElementsByClassName("results-table")[0].innerHTML = data;
          localStorage.setItem("savedData", data);
        })
        .catch((error) => {
          console.error("Произошла ошибка при выполнении AJAX-запроса:", error);
        });
    }
  });


  const clearButton = document.querySelector(".clear-btn");


  clearButton.addEventListener("click", function () {
    const resultsTable = document.querySelector(".results-table");

    // Удаляем все строки в таблице кроме первой (с заголовками)
    localStorage.clear();
    while (resultsTable.rows.length > 1) {
      resultsTable.deleteRow(1);
    }
  })


