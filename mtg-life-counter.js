document.addEventListener('DOMContentLoaded', function() {
    const updateLifeDisplay = (lifeDisplay, life) => {
        lifeDisplay.innerText = life;
        lifeDisplay.style.color = life <= 10 ? 'red' : (life <= 20 ? 'yellow' : 'green');
    };

    const updateCounterDisplay = (counterDisplay, counter, counterValue) => {
        counterDisplay.innerText = `${counter.charAt(0).toUpperCase() + counter.slice(1)}: ${counterValue}`;
    };

    const applySettingsButton = document.getElementById('apply-settings');
    const gameFormatSelect = document.getElementById('game-format');
    const rollDiceButton = document.getElementById('roll-dice');
    const diceTypeSelect = document.getElementById('dice-type');
    const diceResult = document.getElementById('dice-result');
    const resetLifeButton = document.getElementById('reset-life');

    document.addEventListener('click', function(event) {
        const target = event.target;
        if (target.classList.contains('life-button')) {
            const action = target.getAttribute('data-action');
            const lifeDisplay = target.parentElement.querySelector('.life-display');
            let life = parseInt(lifeDisplay.getAttribute('data-life'));
            life = action === 'add' ? life + 1 : life - 1;
            lifeDisplay.setAttribute('data-life', life);
            updateLifeDisplay(lifeDisplay, life);
        } else if (target.classList.contains('counter-button')) {
            const action = target.getAttribute('data-action');
            const counter = target.getAttribute('data-counter');
            const counterDisplay = target.parentElement.querySelector(`.counter-display[data-${counter}]`);
            let counterValue = parseInt(counterDisplay.getAttribute(`data-${counter}`));
            counterValue = action === 'add' ? counterValue + 1 : counterValue - 1;
            counterDisplay.setAttribute(`data-${counter}`, counterValue);
            updateCounterDisplay(counterDisplay, counter, counterValue);
        }
    });

    rollDiceButton.addEventListener('click', function() {
        const diceType = parseInt(diceTypeSelect.value);
        const result = Math.floor(Math.random() * diceType) + 1;
        diceResult.innerHTML = `<span>Result: ${result}</span>`;
    });

    resetLifeButton.addEventListener('click', function() {
        const lifeDisplays = document.querySelectorAll('.life-display');
        lifeDisplays.forEach(function(lifeDisplay) {
            lifeDisplay.setAttribute('data-life', '40');
            updateLifeDisplay(lifeDisplay, 40);
        });

        const counterDisplays = document.querySelectorAll('.counter-display');
        counterDisplays.forEach(function(counterDisplay) {
            const counters = ['poison', 'plus1', 'loyalty', 'energy', 'experience', 'custom'];
            counters.forEach(function(counter) {
                counterDisplay.setAttribute(`data-${counter}`, '0');
                updateCounterDisplay(counterDisplay, counter, 0);
            });
        });
    });

    applySettingsButton.addEventListener('click', function() {
        const format = gameFormatSelect.value;
        let startingLife = 40;
        if (format === 'standard') {
            startingLife = 20;
        } else if (format === 'two-headed-giant') {
            startingLife = 30;
        }
        const lifeDisplays = document.querySelectorAll('.life-display');
        lifeDisplays.forEach(function(lifeDisplay) {
            lifeDisplay.setAttribute('data-life', startingLife);
            updateLifeDisplay(lifeDisplay, startingLife);
        });
    });
});
