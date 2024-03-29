<?php
require_once 'db/data.php';
require_once 'db/config.php';
$directoryPathTest = 'stim/test/';
$directoryPathPractice = 'stim/practice/';
$filesTest = scandir($directoryPathTest);
$filesPractice = scandir($directoryPathPractice);
$fileArrayTest = [];
$fileArrayPractice = [];

foreach ($filesTest as $file) {
    if ($file !== '.' && $file !== '..') {
        $fileArrayTest[] = $file;
    }
}
foreach ($filesPractice as $file) {
  if ($file !== '.' && $file !== '..') {
    $fileArrayPractice[] = $file;
  }
}

$fileArrayTestJSON = json_encode($fileArrayTest);
$fileArrayPracticeJSON = json_encode($fileArrayPractice);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Human Detection Task</title>
  <script>
    //onbeforeunload in body
    function areYouSure() {
      return "Write something clever here...";
    }
    areYouSure();
  </script>
  <!-- set js language variable from php variable in config.php -->
  <script>
    const language = "<?php echo $language; ?>";
    const stimArrayTest = <?php echo $fileArrayTestJSON; ?>;
    const stimArrayPractice = <?php echo $fileArrayPracticeJSON; ?>;
  </script>
  <script type="text/javascript" src="db/validate.js"></script>
  <script type="text/javascript" src="jQuery/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="jsPsych/jspsych.js"></script>
  <script type="text/javascript" src="jsPsych/plugins/jspsych-html-keyboard-response.js"></script>
  <!-- <script type="text/javascript" src="jsPsych/plugins/jspsych-image-keyboard-response.js"></script> -->
  <script type="text/javascript" src="jsPsych/plugins/jspsych-video-keyboard-response.js"></script>
  <link href="jsPsych/css/jspsych.css" rel="stylesheet" type="text/css">
  </link>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body id='unload' onbeforeunload="return areYouSure()">
  <?php
  if ($turkprime_online == true) {
    switch ($language) {
      case 'english':
        include_once "include/consent/english.php";
        break;

      case 'french':
        include_once "include/consent/french.php";
        break;

      case 'german':
        include_once "include/consent/german.php";
        break;
    }
    // echo'<br>';
    // echo'connected';
  } else if ($db_connection_status == true) {
    include_once "include/nda.php";
    // echo'<br>';
    // echo'connected';
  } else if ($db_connection_status == false) {
    include_once "include/intake.php";
    // echo'<br>';
    // echo'not connected';
  }
  ?>
</body>
<footer>
  <script type="text/javascript" src="exp/fn.js"></script>
  <script type="text/javascript" src="exp/conf.js"></script>
  <script type="text/javascript" src="exp/var.js"></script>
  <script type="text/javascript" src="exp/lang.js"></script>
  <script>
    // show page when loaded 
    window.onload = function() {
      $(".loading").css({
        display: "none"
      });
      $(".consent").css({
        display: "block"
      });
      $(".buttonHolder").css({
        display: "block"
      });
    };
  </script>
  <script type="text/javascript">
    // declare NDA required variables
    // let GUID;
    // let subjectID;
    // let sexAtBirth;
    // let siteNumber;
    // let ageAtAssessment;
    // let feedbackLink;
    // let visit;
    // let week;
    if (workerId != "") {
      GUID = "";
      subjectID = "";
      sexAtBirth = "";
      siteNumber = "";
      ageAtAssessment = "";
      feedbackLink = "https://yalesurvey.ca1.qualtrics.com/jfe/form/SV_0chMnwD9uK8Aaiy?workerId=<?php echo $workerId?>";
      visit = "";
      week = "";
    } else {
      if (db_connection == false) {
        GUID = "";
        subjectID = "";
        sexAtBirth = "";
        siteNumber = "";
        ageAtAssessment = "";
        feedbackLink = "https://yalesurvey.ca1.qualtrics.com/jfe/form/SV_0chMnwD9uK8Aaiy?interview_age=<?php echo $ageInMonths ?>&src_subject_id=<?php echo $consortId ?>&study_id=<?php echo $labId ?>&subjectkey=<?php echo $subjectKey ?>&site=<?php echo $institutionAlias ?>&sex=<?php echo $sexAtBirth ?>&phenotype=<?php echo $groupStatus ?>&candidateId=<?php echo $candidateId ?>&visit=<?php echo $visit ?>";
        visit = "";
        week = "";
      } else if (db_connection == true) {
        GUID = "<?php echo $subjectKey ?>";
        subjectID = "<?php echo $consortId ?>";
        workerId = "<?php echo $consortId ?>";
        labId = "<?php echo $labId ?>";
        sexAtBirth = "<?php echo $sexAtBirth ?>";
        siteNumber = "<?php echo $institutionAlias ?>";
        ageAtAssessment = "<?php echo $ageInMonths ?>";
        groupStatus = "<?php echo $groupStatus ?>";
        visit = "<?php echo $visit ?>";
        week = "<?php echo $week ?>";
        feedbackLink = "https://yalesurvey.ca1.qualtrics.com/jfe/form/SV_0chMnwD9uK8Aaiy?interview_age=<?php echo $ageInMonths ?>&src_subject_id=<?php echo $consortId ?>&study_id=<?php echo $labId ?>&subjectkey=<?php echo $subjectKey ?>&site=<?php echo $institutionAlias ?>&sex=<?php echo $sexAtBirth ?>&phenotype=<?php echo $groupStatus ?>&candidateId=<?php echo $candidateId ?>&visit=<?php echo $visit ?>";
      }
    }

    if (turkprime_online === true) {

    } else if (db_connection === false) {
      GUID = "";
      subjectID = "";
      sexAtBirth = "";
      siteNumber = "";
      ageAtAssessment = "";
      feedbackLink = "https://yalesurvey.ca1.qualtrics.com/jfe/form/SV_0chMnwD9uK8Aaiy?interview_age=<?php echo $ageInMonths ?>&src_subject_id=<?php echo $consortId ?>&study_id=<?php echo $labId ?>&subjectkey=<?php echo $subjectKey ?>&site=<?php echo $institutionAlias ?>&sex=<?php echo $sexAtBirth ?>&phenotype=<?php echo $groupStatus ?>&candidateId=<?php echo $candidateId ?>&visit=<?php echo $visit ?>";
      visit = "";
      week = "";
    } else if (db_connection === true) {
      GUID = "<?php echo $subjectKey ?>";
      workerId = "<?php echo $consortId ?>"; // this is necessary so that the data save with the correct id
      subjectID = "<?php echo $consortId ?>";
      sexAtBirth = "<?php echo $sexAtBirth ?>";
      siteNumber = "<?php echo $institutionAlias ?>";
      ageAtAssessment = "<?php echo $ageInMonths ?>";
      visit = "<?php echo $visit ?>";
      week = "<?php echo $week ?>";
      feedbackLink = "https://yalesurvey.ca1.qualtrics.com/jfe/form/SV_0chMnwD9uK8Aaiy?interview_age=<?php echo $ageInMonths ?>&src_subject_id=<?php echo $consortId ?>&study_id=<?php echo $labId ?>&subjectkey=<?php echo $subjectKey ?>&site=<?php echo $institutionAlias ?>&sex=<?php echo $sexAtBirth ?>&phenotype=<?php echo $groupStatus ?>&candidateId=<?php echo $candidateId ?>&visit=<?php echo $visit ?>";
    }
  </script>
</footer>

</html>