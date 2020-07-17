<?php
require_once ('auth.php');

$page_title = "Trip";
require_once ('header.php');


if (!empty($_GET['trip_id'])) {
    //GET trip_id
    $trip_id = $_GET['trip_id'];

    //Connect DB
    require ('db.php');
    //SQL query
    $sql = 'SELECT * from trips WHERE trip_id = :trip_id';
    //Execute & bind parameters
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':trip_id', $trip_id, PDO::PARAM_INT);
    $cmd->execute();
    $trip = $cmd->fetch();

    //Get data from the trip
    $country = $trip['country'];
    $city = $trip['city'];
    $travel_type = $trip['travel_type'];
    $hotel = $trip['hotel'];
    $days = $trip['days'];
    $fee = $trip['fee'];
    $photo = $trip['photo'];

    //Disconnect
    $conn = null;
}
?>

<!-- content -->
<div class="container">
    <h1  class="text_center m-t-40 m-b-20"> Add a New Trip <i class="fas fa-plane"></i></h1>

    <form id="trip_form" class="form-horizontal mt-5 mb-5" method="post" action="save-trip.php" enctype="multipart/form-data">
        <div class="col-sm-8">
            <div class="form-group row">
                <label class="control-label col-sm-4 form_label" for="country">Country: </label>
                <div class="col-sm-8">
                    <input id="country" class="form_input" name="country" required value="<?php echo $country ?? ''; ?>">
                </div>
            </div>
            <div class="form-group  row">
                <label class="control-label col-sm-4 form_label" for="city">City: </label>
                <div class="col-sm-8">
                    <input id="city" class="form_input" name="city" required value="<?php echo $city ?? ''; ?>">
                </div>
            </div>
            <div class="form-group  row">
                <label class="control-label col-sm-4 form_label" for="travel_type">Travel type: </label>
                <div class="col-sm-8">
                    <select id="travel_type" class="form_input" name="travel_type" required>
                        <?php
                        $conn = new PDO('mysql:host=127.0.0.1;dbname=Yu200443723', 'Yu200443723', '0KBPSTzFsH');
                        $sql = 'SELECT * FROM travel_type ORDER BY type_name';
                        $cmd = $conn->prepare($sql);
                        $cmd->execute();
                        $travel_types = $cmd->fetchAll();

                        foreach ($travel_types as $type) {
                            ?>

                            <option value="<?php echo $type['type_name'] ?>" <?php echo (strtolower($type['type_name']) == strtolower($travel_type)) ? 'selected':''; ?>>
                                <?php echo $type['type_name'] ?>
                            </option>

                            <?php
                        }
                        $conn = null;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4 form_label" for="hotel">Hotel: </label>
                <div class="col-sm-8">
                    <select id="hotel_type" class="form_input" name="hotel" required>
                        <?php
                        $conn = new PDO('mysql:host=127.0.0.1;dbname=Yu200443723', 'Yu200443723', '0KBPSTzFsH');
                        $sql = 'SELECT * FROM hotel ORDER BY hotel_name';
                        $cmd = $conn->prepare($sql);
                        $cmd->execute();
                        $hotels = $cmd->fetchAll();

                        foreach ($hotels as $type) {
                            ?>
                            <option value="<?php echo $type['hotel_name'] ?>" <?php echo(strtolower($type['hotel_name']) == strtolower($hotel) ? 'selected':''); ?>>
                                <?php echo $type['hotel_name'] ?>
                            </option>
                        <?php }
                        $conn = null;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4 form_label" for="days">Days(1-255): </label>
                <div class="col-sm-8">
                    <input id="days" class="form_input" name="days" type="number" min="1" max="255" required value="<?php echo $days ?? ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4 form_label" for="fee">Fee(0-9999.99): </label>
                <div class="col-sm-8">
                    <input id="fee" class="form_input" name="fee" type="number" step="0.01" min="0" max="9999.99" required value="<?php echo $fee ?? ''; ?>">
                </div>
            </div>
            <div class="form-group float-right">
                <input name="trip_id" type="hidden" value="<?php echo $trip_id ?? ''; ?>" />
                <!-- <button id="view_trips" type="button" class="btn btn-success float-right">View Trips</button> -->
                <button type="submit" class="btn btn-success float-right">Save trip</button>
            </div>
        </div>
        <div  class="col-sm-4">
            <div class="form-group">
                <label class="control-label form_label" for="photo">Photo: </label>
                <div>
                    <input id="photo" name="photo" type="file">
                </div>
                <?php if(!empty($photo)) { ?>
                <div id="tripImg">
                    <img src="images/<?php echo $photo; ?>" alt="Trip Image">
                </div>
                <?php } ?>
            </div>
        </div>
    </form>
</div>

<!-- Import Bootstap JS -->
<!-- Method 2 - From local path -->
<!-- jQuery slim build, which excludes the ajax and effects modules -->
<script type="text/javascript" src="../../assets/jquery/3.5.1/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../../assets/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Download form popper.js website or Maven repository website -->
<script type="text/javascript" src="../../assets/bootstrap/4.4.1/js/bootstrap.min.js"></script>


<?php
require_once ('footer.php');
?>