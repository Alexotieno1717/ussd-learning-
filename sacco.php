<?php
declare(strict_types=1);

/*
 * OliveTree SACCO terminal USSD practice app.
 * Run with: php sacco.php
 * All account details and transactions in this program are sample data.
 */

function line()
{
    echo str_repeat('-', 48) . PHP_EOL;
}

function readInput(string $prompt): string
{
    echo $prompt;
    $value = fgets(STDIN);
    return $value === false ? 'q' : trim($value);
}

function showWelcome()
{
    line();
    echo "       Welcome to OliveTree SACCO\n";
    line();
    echo "1. Check Balance\n";
    echo "2. Loan Application\n";
    echo "3. Pay via M-PESA\n";
    echo "4. Customer Support\n";
    echo "0. Exit\n";
    line();
}

function pauseForEnter()
{
    readInput("\nPress Enter to return to the main menu...");
}

function checkBalance()
{
    line();
    echo "             CHECK BALANCE\n";
    line();
    echo "Your available balance is KES 12,450.00\n";
    pauseForEnter();
}

function applyForLoan()
{
    line();
    echo "            LOAN APPLICATION\n";
    line();
    echo "Choose a loan type:\n";
    echo "1. Emergency loan\n";
    echo "2. Development loan\n";
    echo "0. Back to main menu\n";

    $type = readInput("Choice: ");
    if ($type === '0') {
        return;
    }
    if (!in_array($type, ['1', '2'], true)) {
        echo "Please choose 1, 2, or 0.\n";
        pauseForEnter();
        return;
    }

    $loanName = $type === '1' ? 'Emergency loan' : 'Development loan';
    $amount = readInput("Enter the amount you would like to request (KES): ");
    if (!ctype_digit($amount) || (int) $amount < 100 || (int) $amount > 500000) {
        echo "Enter a whole amount between KES 100 and KES 500,000.\n";
        pauseForEnter();
        return;
    }

    echo "\nSample application received.\n";
    echo "Loan type: {$loanName}\n";
    echo "Requested amount: KES " . number_format((int) $amount) . "\n";
    echo "Reference: JK-" . date('ymd') . "-001\n";
    pauseForEnter();
}

function payViaMpesa()
{
    line();
    echo "              PAY VIA M-PESA\n";
    line();
    echo "This is a practice flow. It will not send money or prompt M-PESA.\n";

    $amount = readInput("Enter contribution amount (KES), or 0 to go back: ");
    if ($amount === '0') {
        return;
    }
    if (!ctype_digit($amount) || (int) $amount < 1 || (int) $amount > 150000) {
        echo "Enter a whole amount between KES 1 and KES 150,000.\n";
        pauseForEnter();
        return;
    }

    echo "\nSample payment request:\n";
    echo "Amount: KES " . number_format((int) $amount) . "\n";
    echo "Paybill: 123456 (example only)\n";
    echo "Account: Your SACCO membership number\n";
    pauseForEnter();
}

function customerSupport()
{
    while (true) {
        line();
        echo "            CUSTOMER SUPPORT\n";
        line();
        echo "1. Office hours\n";
        echo "2. How to become a member\n";
        echo "3. Contact details\n";
        echo "0. Back to main menu\n";
        line();

        $choice = readInput("Choose an option: ");
        switch ($choice) {
            case '1':
                echo "\nOur sample office hours are Monday to Friday, 8:00 AM to 5:00 PM.\n";
                pauseForEnter();
                break;
            case '2':
                echo "\nVisit a OliveTree SACCO branch with your ID and membership form.\n";
                pauseForEnter();
                break;
            case '3':
                echo "\nCall our sample support line: 0700 000 000.\n";
                pauseForEnter();
                break;
            case '0':
                return;
            default:
                echo "Please choose 1, 2, 3, or 0.\n";
                pauseForEnter();
        }
    }
}

echo "\nThis is a terminal practice app. It does not connect to a real SACCO.\n";

while (true) {
    showWelcome();
    $choice = readInput("Enter your choice: ");

    switch ($choice) {
        case '1':
            checkBalance();
            break;
        case '2':
            applyForLoan();
            break;
        case '3':
            payViaMpesa();
            break;
        case '4':
            customerSupport();
            break;
        case '0':
        case 'q':
        case 'Q':
            echo "\nThank you for using OliveTree SACCO. Goodbye!\n\n";
            exit(0);
        default:
            echo "Sorry, that option is not available. Choose 1, 2, 3, 4, or 0.\n";
            readInput("Press Enter to try again...");
    }
}
