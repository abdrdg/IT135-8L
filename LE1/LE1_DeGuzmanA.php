<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab Experiment 1</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

</head>
<body>
  <header>
  
  </header>
  <main>
      <form>
        <div class="grid-container">
          <div class="grid-x grid-margin-x grid-margin-y">
            <div class="cell auto">
              <h2>F.L.A.M.E.S</h2>
            </div>
          </div>

          <div class="grid-y grid-padding-y">
            <div class="grid-x grid-margin-x">
              <div class="medium-6 cell">
                <label>Your Name
                  <input type="text" name="user_name" placeholder="Your Name">
                </label>
              </div>

              <div class="medium-6 cell">
                <label>Crush's Name
                  <input type="text" name="crush_name" placeholder="Crush's Name">
                </label>
              </div>
            </div>
          </div>

          <div class="grid-x grid-padding-y">
            <button type="submit" class="button cell auto" name="submit-btn">
              Submit
            </button>
          </div>
        </div>
      </form>

<?php
  if (isset($_GET['submit-btn']))
  {
    $user_name = strtolower(trim($_GET['user_name']));
    $crush_name = strtolower(trim($_GET['crush_name']));
    $total_count = 0;

    for($i = 0; $i < strlen($user_name); $i++)
    {
      if(strpos($crush_name, $user_name[$i]) !== false)
      {
        $total_count += 1;
      }
    }

    for($i = 0; $i < strlen($crush_name); $i++)
    {
      if(strpos($user_name, $crush_name[$i]) !== false)
      {
        $total_count += 1;
      }
    }

    $remainder = $total_count % 6;
    switch ($remainder) {
      case 0:
        $result = 'Soulmates';
        break;
      case 1:
        $result = 'Friends';
        break;
      case 2:
        $result = 'Lovers';
        break;
      case 3:
        $result = 'Anger';
        break;
      case 4:
        $result = 'Married';
        break;
      case 5:
        $result = 'Engaged';
        break;
      default:
        $result = 'Incompatible';
        break;
    }

    echo "
    <br>
    <div class='grid-container result'>
            <div class='grid-y'>
             <div class='medium-6 cell'>";
    
  if($user_name !== '' && $crush_name !== '')
    {
      echo "<h2>Destiny:</h2>";
      echo "<h1>".ucfirst($user_name)." ♥ ".ucfirst($crush_name)." = $result</h1>";
    }
  else
    {
      echo "<p>Please complete the names!</p>";
    }
  }
  echo "    </div>
          </div>
        </div>";
?>

  </main>
</body>
</html>