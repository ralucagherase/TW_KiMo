<?php
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>KidMonitor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        #map {
            height: 100%;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script type="text/javascript">
        var map,
            markers = [],
            bounds,
            infoWindow = [],
            circles = []
        notifications = [];

        var session = {};
        session.user = <?php echo json_encode($_SESSION['user']); ?>;
    </script>
</head>
<body>
<?php
$base_uri = str_replace('/home.php', '', $_SERVER['REQUEST_URI']);
?>
<a href="<?php echo $base_uri; ?>/logout.php" class="btn btn-danger logout-btn">Logout</a>
<div class="dropdown notification-btn">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Notifications
        <span class="badge">0</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"></ul>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Configureaza markerul</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger configMarkerFormErrorMessage"></div>
                <form id="modal-config-form" data-marker-id="">
                    <div class="form-group">
                        <label for="marker-type-select">Preference</label>
                        <select name="marker_type" class="form-control" id="marker-type-select">
                            <option value="child">Copil</option>
                            <option value="animal">Animal</option>
                            <option value="object">Obiect</option>
                            <!-- <option value="target">Target</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marker-title">Nume</label>
                        <input name="title" class="form-control" id="marker-title">
                    </div>
                    <div class="form-group">
                        <label for="marker-movable-select">Mobil</label>
                        <select name="marker_movable" class="form-control" id="marker-movable-select">
                            <option value="1">Da</option>
                            <option value="0">Nu</option>
                        </select>
                    </div>
                    <input type="hidden" name="id"/>

                    <input type="hidden" name="lat"/>
                    <input type="hidden" name="lng"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Inchide</button>
                <button type="button" id="save-config" class="btn btn-primary">Salveaza</button>
            </div>
        </div>
    </div>
</div>
<div id="map"></div>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/markerConfig.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_KsHe3ZXqIKApA-LUAnzFeZPs1W_9P0Y&callback=initMap&libraries=geometry" async defer></script>
</body>
</html>
