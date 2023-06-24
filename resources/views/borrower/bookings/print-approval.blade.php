<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Item Loan Authorization</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                margin-top: 5px;
                padding: 0;
            }

            body {
                font-family: 'Roboto', sans-serif;
                line-height: 1.4;
            }

            .center-align {
                text-align: center;
                line-height: 1.25;
            }

            .blue-heading {
                color: #00579e;
                font-size: 16pt;
                margin: 2rem 0 2rem 0;
            }

            .text-bold {
                font-weight: bold;
            }

            .list-items {
                list-style-type: disc;
                padding-left: 20px;
                list-style: none;
            }

            .list-items li {
                font-size: 12pt;
            }

            .mb-0 {
                margin-bottom: 0 !important;
            }

            .mt-0 {
                margin-top: 0 !important;
            }
        </style>
    </head>
    <body>
        <p class="center-align mb-0">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/sipinjam.png'))) }}" width="152" height="88" alt="">
        </p>
        <p class="center-align mb-0">
            <strong>Unit: {{ $unit }}</strong>
        </p>
        <p class="center-align mt-0">
            <strong>Location: {{ $unitLocation }}</strong>
        </p>
        <hr>
        <p class="center-align blue-heading text-bold mb-0">
            ITEM LOAN AUTHORIZATION
        </p>
        <p class="center-align mt-0">
            <strong>Usage ID: {{ $usageId }}</strong>
        </p>
        <p>
            The admin unit has approved the borrower on behalf of:
        </p>
        <ul class="list-items">
            <li>
                <strong>Borrower:</strong> {{ $name }}
            </li>
            <li>
                <strong>Name:</strong> {{ $name }}
            </li>
            <li>
                <strong>User ID:</strong> {{ $id }}
            </li>
            <li>
                <strong>email:</strong> {{ $email }}
            </li>
            <li>
                <strong>Phone number:</strong> {{ $phone }}
            </li>
        </ul>
        <p>
            To borrow item(s) with the following details:
        </p>
        <ul class="list-items">
            <li>
                <strong>Name:</strong> {{ $itemName }}
            </li>
            <li>
                <strong>Item ID:</strong> {{ $itemId }}
            </li>
            <li>
                <strong>Booking ID:</strong> {{ $bookId }}
            </li>
            <li>
                <strong>Borrowed amount:</strong> {{ $quantity }}
            </li>
            <li>
                <strong>Start date:</strong> {{ $startDate }}
            </li>
            <li>
                <strong>End date:</strong> {{ $endDate }}
            </li>
            <li>
                <strong>Return date:</strong> {{ $dueDate }}
            </li>
            <li>
                <strong>Usage note:</strong><br> {{ $usageNote }}
            </li>
        </ul>
        <p>
            Please come to our unit to pick up the items you booked before the start date you submitted. If you need assistance, please contact:
        </p>
        <ul class="list-items">
            <li>
                <strong>Admin unit:</strong>
            </li>
            <li>
                <strong>Name:</strong> {{ $adminName }}
            </li>
            <li>
                <strong>Phone number:</strong> {{ $adminPhone }}
            </li>
        </ul>
        <p class="center-align">
            Approval date and time: {{ $createdAt }}
        </p>
    </body>
</html>