<?php
/*
Plugin Name: MTG Life Counter
Description: A simple life counter for Magic: The Gathering.
Version: 1.2.1
Author: Void, Corp https://voidcorp.net
*/

function mtg_life_counter_enqueue_scripts() {
    wp_enqueue_style('mtg-life-counter-style', plugins_url('mtg-life-counter.css', __FILE__));
    wp_enqueue_script('mtg-life-counter-script', plugins_url('mtg-life-counter.js', __FILE__), array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'mtg_life_counter_enqueue_scripts');

function mtg_life_counter_shortcode($atts) {
    $atts = shortcode_atts(array(
        'players' => '1',  // Default to 1 player
    ), $atts, 'mtg_life_counter');
    $players = intval($atts['players']);
    ob_start();
    ?>
    <div id="mtg-life-counter">
        <h1 style="color: red;">Magic: The Gathering – Life Counter</h1>
        <div class="game-settings">
            <label for="game-format" style="color: blue;">Select Game Format:</label>
            <select id="game-format">
                <option value="commander">Commander</option>
                <option value="two-headed-giant">Two-Headed Giant</option>
                <option value="standard">Standard</option>
            </select>
            <button id="apply-settings">Apply</button>
        </div>
        <div class="players">
            <?php for ($i = 1; $i <= $players; $i++) : ?>
            <div class="player" data-player="<?php echo $i; ?>">
                <h2>Player <?php echo $i; ?></h2>
                <div class="life-counter">
                    <div class="life-display" data-life="40">40</div>
                    <button class="life-button" data-action="add">+1 Life</button>
                    <button class="life-button" data-action="subtract">-1 Life</button>
                </div>
                <div class="counters">
                    <div class="counter">
                        <div class="counter-display" data-poison="0">Poison: 0</div>
                        <button class="counter-button" data-action="add" data-counter="poison">+1 Poison</button>
                        <button class="counter-button" data-action="subtract" data-counter="poison">-1 Poison</button>
                    </div>
                    <div class="counter">
                        <div class="counter-display" data-plus1="0">Plus1: 0</div>
                        <button class="counter-button" data-action="add" data-counter="plus1">+1 +1/+1</button>
                        <button class="counter-button" data-action="subtract" data-counter="plus1">-1 +1/+1</button>
                    </div>
                    <div class="counter">
                        <div class="counter-display" data-loyalty="0">Loyalty: 0</div>
                        <button class="counter-button" data-action="add" data-counter="loyalty">+1 Loyalty</button>
                        <button class="counter-button" data-action="subtract" data-counter="loyalty">-1 Loyalty</button>
                    </div>
                    <div class="counter">
                        <div class="counter-display" data-energy="0">Energy: 0</div>
                        <button class="counter-button" data-action="add" data-counter="energy">+1 Energy</button>
                        <button class="counter-button" data-action="subtract" data-counter="energy">-1 Energy</button>
                    </div>
                    <div class="counter">
                        <div class="counter-display" data-experience="0">Experience: 0</div>
                        <button class="counter-button" data-action="add" data-counter="experience">+1 Experience</button>
                        <button class="counter-button" data-action="subtract" data-counter="experience">-1 Experience</button>
                    </div>
                    <div class="counter">
                        <div class="counter-display" data-custom="0">Custom: 0</div>
                        <button class="counter-button" data-action="add" data-counter="custom">+1 Custom</button>
                        <button class="counter-button" data-action="subtract" data-counter="custom">-1 Custom</button>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div class="dice-roller">
            <label for="dice-type" style="color: blue;">Dice Type:</label>
            <select id="dice-type">
                <option value="4">D4</option>
                <option value="6">D6</option>
                <option value="8">D8</option>
                <option value="10">D10</option>
                <option value="12">D12</option>
                <option value="20">D20</option>
            </select>
            <button id="roll-dice">Roll</button>
            <div id="dice-result"></div>
        </div>
        <button id="reset-life">Reset</button>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('mtg_life_counter', 'mtg_life_counter_shortcode');
?>
