PHP Dice Roller
====================

[![Build Status (develop)](https://travis-ci.org/chimericdream/DiceRoller.svg?branch=develop)](https://travis-ci.org/chimericdream/DiceRoller)
[![Build Status (master)](https://travis-ci.org/chimericdream/DiceRoller.svg?branch=master)](https://travis-ci.org/chimericdream/DiceRoller)

DESCRIPTION
---------------------

This script is a simple dice roller written in PHP. It is useful for any type of
game in which basic die rolling is needed and can also be dropped into any
application which needs to generate sets of random numbers that fit certain
criteria.

FEATURES
---------------------

* Dice: Add as many dice as you want of varying types
* Modifiers: Add modifiers to any die rolls, down to the individual die level if you wish
* Macros: Save multiple types of rolls (e.g. for different weapons and/or situations) as macros for quick setup and rolling later.
* Chaining: Write cleaner code by chaining multiple functions together

EXAMPLE
---------------------

The following example uses a flaming longsword in Dungeons & Dragons. It assumes
the character has a Strength modifier of +3.

    echo $roller->addDice(1, 8, 4, 'longsword')->addDice(1, 6, 0, 'fire')->roll();

This example creates and saves macros for multiple weapons and rolls them each
in an arbitrary order.

    $roller->addDice(1, 8, 4, 'longsword')->addDice(1, 6, 0, 'fire')->saveMacro('flaming longsword')->clear()
           ->addDice(1, 6, 4, 'shortsword')->addDice(1, 6, 0, 'frost')->saveMacro('frost shortsword')->clear()
           ->addDice(2, 6, 6, 'greatsword')->addDice(1, 4, 0, 'acid')->saveMacro('acid greatsword')->clear();

    echo $roller->rollMacro('flaming longsword') . '<br>';
    echo $roller->rollMacro('frost shortsword') . '<br>';
    echo $roller->rollMacro('acid greatsword') . '<br>';

COMMENTS?
---------------------

Feel free to email me at <diceroller@worldofpannotia.com> any comments or
suggestions you have, or use Github's issue tracker <https://github.com/chimericdream/DiceRoller/issues>
tool.

### Bug Reports

Please use the issue tracker <https://github.com/chimericdream/DiceRoller/issues>
built into Github for all bug reports.

LICENSE
---------------------

This software is released for free under the MIT license. See the LICENSE file
for the full license text.