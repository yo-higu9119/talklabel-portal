<?php
$seminarData = new SeminarData($session->getMemberName());
$seminarApplicantData = new SeminarApplicantData($session->getMemberName());
$VenueData = new VenueData($session->getMemberName());
$VenueList = $VenueData->getList();
?>
