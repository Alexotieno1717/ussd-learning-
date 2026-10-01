# USSD practice

This beginner example runs in your terminal. It does not need an API token, internet connection, or callback URL. All balances, phone numbers, loan requests, and payment details are examples; it does not access a real SACCO or send money.

## Run the program

Open a terminal in this project folder and run:

    php sacco.php

Choose a number from the main menu. In Customer Support, choose a topic, then press Enter to return to its menu. Choose 0 to go back to the main menu. Choose 0 from the main menu to quit.

## The menu flow

The program displays the main menu, reads the choice, and uses a switch statement to decide which function to run:

- Check Balance shows a sample balance.
- Loan Application asks for a loan type and amount, then displays a sample confirmation.
- Pay via M-PESA shows a mock payment prompt without making a payment.
- Customer Support opens a second menu with help topics.

The functions are in sacco.php. Start with showWelcome() and the switch statement near the bottom. Those parts connect menu choices to the screens. Later, we can make the program behave more like a real USSD gateway by accepting the user's choices as a sequence such as 4 then 1.
