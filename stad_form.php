<?php
require_once "lib/autoload.php";
$userService = $container->getUserService();
$user = $userService->loadUserFromId($_SESSION['usr_id']);

if ($user->doesThisUserHaveAdminRigths()) {
    if ($user->getAdminPower() > 50) {
        $viewService->addMessage('Yeaa you got power man', "error");

    }
    else {
        $viewService->addMessage('You don\'t have enough power today, mister Admin', "error");
    }

}
$css = array( "style.css" );
$viewService->basicHead($css, "Formulier Stad");
?>
<div class="container">
    <div class="row">

        <?php
        $cityService = $container->getCityService();
        $city = $cityService->fetchCityDataByID($id = $_GET['id']);
//
        print $viewService->returnMessages();
        $template = $viewService->loadTemplate("stad_form");
        print $viewService->replaceCities($city, $template);

        ?>

    </div>
</div>

</body>
</html>