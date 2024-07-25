<?php

// database connection
include("backend/database.php");

?>
<script>
    // function get city then append to url
    function displaycity() {
        
        // get selected state
        var state = document.getElementById("negeri").value;
        // pass selected state value to the id
        document.getElementById("state_id").innerHTML = state;
        // open page with the appended url
        window.location.href = "rooms-create.php?state=" + state;

    }

    // function create fixed value for selcted selection
    function setFixedValue() {
        // get the query part of url
        const search = window.location.search;
        const searchNew = new URLSearchParams(search); //create urlsearchparam obejct then set value = search
        const getState = searchNew.get('state') // get value for state punya; eg state = 2, value akan jdi 2 to getState


        var allState = document.getElementById("negeri");
        for (var i = 0; i < allState.options.length; i++) { // allState.options.length = find how many state
            //if option index [i] = value getState, true kan attribute selected, default first option
            if (allState.options[i].value == getState) {
                allState.options[i].selected = true;
                break;
            }
        }


    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/components/card.css" />
    <link rel="stylesheet" href="css/components/stats.css" />
    <link rel="stylesheet" href="css/components/badge.css" />
    <link rel="stylesheet" href="css/components/input.css" />
    <link rel="stylesheet" href="css/components/header.css" />
    <link rel="stylesheet" href="css/components/button.css" />
    <link rel="stylesheet" href="css/components/heading.css" />
    <link rel="stylesheet" href="css/components/table.css" />
    <link rel="stylesheet" href="css/components/switch.css" />
    <link rel="stylesheet" href="css/components/hamburgers.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css" />
    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <title>Create Room | Meetbook – Easy Meeting Room Booking</title>
</head>

<body onload="setFixedValue()">
    <div class="header">
        <!-- header -->
        <?php include("include/header.php"); ?>
        <div class="content">
            <h1>Create Room</h1>
        </div>
    </div>

    <!-- alert message -->
    <?php
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] == '2') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Room Name already taken. Please choose another name</div></div>";
        }
    }

    ?>

    <div class="body">
        <!-- content -->
        <div class="content">
            <!-- start form -->
            <form action="backend/create-room.php" method="post">
                <div class="group">
                    <div>
                        <h4 class="heading">
                            Room Details
                            <div class="subheading">Fill in the room details.</div>
                        </h4>
                    </div>
                    <div>
                        <div class="card">
                            <div class="content">

                                <div class="fields-split">
                                    <div class="field">
                                        <label for="country">Country</label>
                                        <input name="country" type="text" id="country" value="Malaysia" disabled />
                                        <label for="country" class="guide"></label>
                                    </div>
                                    <div class="field">
                                        <label for="state">State</label>

                                        <label for="state" class="guide"></label>
                                        <select name="state" type="text" id="negeri" onchange="displaycity()" required>
                                            <!-- <option id="fixed" value=""></option> -->
                                            <?php
                                            $sqlState = "SELECT * FROM `state`";
                                            try {
                                                $resultState = mysqli_query($conn, $sqlState);
                                                if (mysqli_num_rows($resultState) > 0) {
                                                    while ($rowState = mysqli_fetch_assoc($resultState)) {
                                                        echo "<option value='{$rowState['stateID']}'>{$rowState['stateName']}</option>";
                                                    }
                                                }
                                            } catch (mysqli_sql_exception) {
                                                echo "error";
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="postcode">Postcode</label>
                                        <input name="poscode" type="text" id="postcode" required placeholder="50603" />
                                        <label for="postcode" class="guide" required></label>
                                    </div>
                                    <div class="field">


                                        <label for="city">City</label>

                                        <select name="city">
                                            <option>Please choose state first</option>
                                            <?php
                                            if (isset($_REQUEST['state'])) {
                                                $state = $_REQUEST['state']; //fetch value from URL query
                                                $sqlCity = "SELECT * FROM `city` WHERE stateID = '$state' ORDER BY cityName";
                                                try {
                                                    $resultCity = mysqli_query($conn, $sqlCity);
                                                    if (mysqli_num_rows($resultCity) > 0) {
                                                        while ($rowCity = mysqli_fetch_assoc($resultCity)) {
                                                            echo "<option value='{$rowCity['cityID']}'>{$rowCity['cityName']}</option>";
                                                        }
                                                    }
                                                } catch (mysqli_sql_exception) {
                                                    echo 'error';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="city" class="guide"></label>
                                    </div>

                                </div>
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="address_1">Address Line 1</label>
                                        <input name="address1" id="address_1" type="text" placeholder="Unit A-01-01, Level 1" required />
                                        <label for="address_1" class="guide">
                                            E.g: unit, floor, etc.
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="address_2">Address Line 2</label>
                                        <input name="address2" id="address_2" type="text" placeholder="Stark Tower" required />
                                        <label for="address_2" class="guide">
                                            E.g: block, apartment, building name, etc.
                                        </label>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="room_name">Room Name</label>
                                    <input name="roomName" id="room_name" type="text" placeholder="Heroes Lab" required />
                                    <label for="room_name" class="guide">
                                        Enter a clear and concise room name.
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button">Save Room</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div>
                        <h4 class="heading">
                            Room Capacity
                            <div class="subheading">
                                The capacity of which this room can host.
                            </div>
                        </h4>
                    </div>
                    <div>
                        <div class="card">
                            <div class="content">
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="minimum">Min. Capacity</label>
                                        <input id="minimum" type="number" min="0" max="99999" placeholder="0" />
                                        <label for="minimum" class="guide">
                                            Minimum room capacity (0-99999 pax).
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="maximum">Max. Capacity</label>
                                        <input id="maximum" type="number" min="0" max="99999" placeholder="100" />
                                        <label for="maximum" class="guide">
                                            Maximum room capacity (0-99999 pax).
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button">Save Room</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form><!--end of form-->

        </div>
    </div>
    <!-- create value for state_id when fx display city called-->
    <?php
    $value = "<p id = 'state_id' ></p>";
    echo $value; ?>

    <script>
        function openMenu() {
            var menu = document.getElementById("menu");
            var hamburger = document.getElementById("hamburger");
            if (menu.classList && hamburger.classList) {
                menu.classList.toggle("open");
                hamburger.classList.toggle("is-active");
            }
        }
    </script>
</body>

</html>