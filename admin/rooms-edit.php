<?php
// database connection
include("backend/database.php");

// get roomID
$roomID = " ";
if (isset($_REQUEST['id'])) {
    $roomID = $_REQUEST['id'];
}

// get room detail
$sql  = " SELECT * FROM `room` WHERE roomID = '$roomID' ";
try {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $roomID = $row['roomID'];
            $roomName = $row['roomName'];
            $address1 = $row['address1'];
            $address2 = $row['address2'];
            $poscode = $row['poscode'];
            $minCapacity = $row['minCapacity'];
            $maxCapacity = $row['maxCapacity'];
            $roomAvailability = $row['roomAvailability'];
            $cityID = $row['cityID'];
        }
    } else {
        echo "Could not find room";
    }
} catch (mysqli_sql_exception) {
    echo "Could not find room";
}

// get city and state
$sql_location = " SELECT * FROM `city` WHERE cityID = '$cityID' ";
$resultLocation = mysqli_query($conn, $sql_location);
if (mysqli_num_rows($resultLocation) > 0) {
    while ($row = mysqli_fetch_assoc($resultLocation)) {
        $cityID = $row['cityID'];
        $cityName = $row['cityName'];
        $stateID = $row['stateID'];
    }
} else {
    echo "Could not find location";
}


?>
<script>
    // function get city then append to url
    function displaycity() {
        var state = document.getElementById("negeri").value;

        document.getElementById("state_id").innerHTML = state;

        const search = window.location.search;
        const searchNew = new URLSearchParams(search);
        const getID = searchNew.get('id')

        window.location.href = "rooms-edit.php?id=" + getID + "&state=" + state;

    }

    // function create fixed value for selcted selection
    function setFixedValue() {

        const search = window.location.search;
        const searchNew = new URLSearchParams(search); //create urlsearchparam obejct then set value kpd search
        const getState = searchNew.get('state'); // get value for state punya; eg state = 2, value akan jdi 2
        const getCity = searchNew.get('city');

        // state selection
        var allState = document.getElementById("negeri");
        for (var i = 0; i < allState.options.length; i++) { // allState.options.length = find how many state
            //if option index [i] = value getState, true kan attribute selected, default first option
            if (allState.options[i].value == getState) {
                allState.options[i].selected = true;
                break;
            }
        }
        // city selection
        var allcity = document.getElementById("city");
        for (var i = 0; i < allcity.options.length; i++) { // allCity.options.length = find how many city
            //if option index [i] = value getCity, true kan attribute selected, default first option
            if (allcity.options[i].value == getCity) {
                allcity.options[i].selected = true;
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

    <title>Edit Room | Meetbook – Easy Meeting Room Booking</title>
</head>

<body onload="setFixedValue()">
    <div class="header">
        <!-- header -->
        <?php include("include/header.php"); ?>
        <div class="content">
            <h1>Edit Room</h1>
        </div>
    </div>

    <?php
    // alert message
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] == '1') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-success" role="alert">';
            echo "Changes save successfully</div></div>";
        } elseif ($_REQUEST['status'] == '2') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Changes fail to save. Check the form again.</div></div>";
        }
    }
    ?>

    <div class="body">
        <div class="content">
            <!-- start form -->
            <form action="backend/edit-room.php" method="post">
                <input type="hidden" value="<?php echo $roomID ?> " name="roomID">
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
                                        <input name="countryID" type="text" id="country" value="Malaysia" disabled />
                                        <label for="country" class="guide"></label>
                                    </div>
                                    <div class="field">
                                        <label for="state">State</label>

                                        <label for="state" class="guide"></label>
                                        <select name="stateID" type="text" id="negeri" onchange="displaycity()" required>>
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
                                        <input name="poscode" type="text" id="postcode" required placeholder="50603" value="<?php echo $poscode; ?>" />
                                        <label for="postcode" class="guide" required></label>
                                    </div>
                                    <div class="field">


                                        <label for="city">City</label>

                                        <select name="cityID" id="city">
                                            <option>Please choose state first</option>
                                            <?php
                                            if (isset($_REQUEST['state'])) {
                                                $state = $_REQUEST['state']; //fetch value from URL query
                                                $sqlCity = "SELECT * FROM `city` WHERE stateID = '$state' ";
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
                                        <input name="address1" id="address_1" type="text" placeholder="Unit A-01-01, Level 1" value="<?php echo $address1; ?>" required />
                                        <label for="address_1" class="guide">
                                            E.g: unit, floor, etc.
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="address_2">Address Line 2</label>
                                        <input name="address2" id="address_2" type="text" placeholder="Stark Tower" value="<?php echo $address2; ?>" required />
                                        <label for="address_2" class="guide">
                                            E.g: block, apartment, building name, etc.
                                        </label>
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="room_name">Room Name</label>
                                    <input name="roomName" id="room_name" type="text" placeholder="<?php echo $roomName; ?>" value="<?php echo $roomName; ?>" required />
                                    <label for="room_name" class="guide">
                                        Enter a clear and concise room name.
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button" type="submit">Save Room</button>
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
                                        <input id="minimum" type="number" min="0" max="99999" placeholder="0" value="<?php echo $minCapacity; ?>" name="minCapacity" />
                                        <label for="minimum" class="guide">
                                            Minimum room capacity (0-99999 pax).
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="maximum">Max. Capacity</label>
                                        <input id="maximum" type="number" min="0" max="99999" placeholder="100" value="<?php echo $maxCapacity; ?>" name="maxCapacity" />
                                        <label for="maximum" class="guide">
                                            Maximum room capacity (0-99999 pax).
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button" type="submit">Save Room</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <div>
                        <h4 class="heading">
                            Danger Zone
                            <div class="subheading">Note: deleting room is irreversible!</div>
                        </h4>
                    </div>
                    <div>
                        
                        <!-- checked the checkbox according roomAvailability -->
                        <div class="card">
                            <div class="content">
                                <?php if (isset($roomAvailability)) {

                                    if ($roomAvailability == 1) {
                                ?>
                                        <div class="fields-row">
                                            <div class="field">
                                                <label for="enable" class="cursor-pointer">
                                                    Enable this room
                                                    <div class="guide">
                                                        Turn this on to enable booking for this room.
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="field">
                                                <div class="switch">
                                                    <div>
                                                        <input type="checkbox" id="enable" name="enableDisable" checked />
                                                        <label for="enable"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div class="fields-row">
                                            <div class="field">
                                                <label for="enable" class="cursor-pointer">
                                                    Enable this room
                                                    <div class="guide">
                                                        Turn this on to enable booking for this room.
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="field">
                                                <div class="switch">
                                                    <div>
                                                        <input type="checkbox" id="enable" name="enableDisable" />
                                                        <label for="enable"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                <?php }
                                } ?>
                                <div class="fields-row">
                                    <div class="field">
                                        <a href="backend/delete-room.php" data-toggle="modal" class="red" data-target="#deleteModal" style="font-weight: 500">
                                            Delete this room permanently
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button" type="submit">Save Room</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form> <!--end form-->

        </div>
    </div>
    <!-- delete pop -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this room?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    <form action="backend/delete-room.php" method="post" id="deleteForm">
                        <input type="hidden" value="<?php echo $roomID ?>" name="roomID" id="roomID">
                        <button type="submit" class="btn btn-danger" id="deleteButton">Delete</a>
                    </form>


                </div>
            </div>
        </div>
    </div><!-- end pop up -->
    
    <!-- script for popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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