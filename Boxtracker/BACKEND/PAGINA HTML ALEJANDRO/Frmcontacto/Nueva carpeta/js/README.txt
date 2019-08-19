DOCUMENTATION

To get ContentManagerAPI.js documentation, just run "yuidoc ."
You must of course install yuidoc first, "node -g install yuidocjs"

EXAMPLE USAGE

    <script type="text/javascript" src="js/require-jquery.js"></script>
    <script type="text/javascript">
        require(['js/content-manager-api'], function (api) {
            // the api variable now holds an instance of the Content Manager API
        });
    </script>

LIBRARIES USED

jquery
require.js
hogan.js
json2.js