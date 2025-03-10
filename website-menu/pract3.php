<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>jQuery & AJAX Practice</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      /* margin-top: 50px; */
      border: 1px solid black;
    }

    .container-fluid {
      padding: 10px;
      background-color: #ffc0cb;
    }

    #success-message {
      background-color: rgb(55, 134, 62);
      color: white;
    }

    #error-message {
      background-color: #df5353;
      color: white;
    }

    /* #form-data{
      background-color: cornsilk;
      border: 1px solid #ddd; 
      border: 1px solid black; 
      padding: 20px;
    } */
    #form-data {
      display: flex;
      align-items: center;
      gap: 14px;
      /* Spacing between elements */
      flex-wrap: wrap;
      /* Ensures responsiveness */
    }

    #form-data label {
      font-weight: bold;
    }

    #form-data input {
      padding: 5px 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #save-button {
      padding: 5px;
      font-size: 15px;
      cursor: pointer;
      background-color: rgb(34 149 76);
      color: white;
      border: none;
    }

    .delete-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 4px 15px;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!-- <p id="para">This is my paragraph 1</p>
    <p id="pa">This is my paragraph 2</p>
    <p>This is my paragraph 3</p>
    <p>This is my paragraph 4</p>
    <input
      type="button"
      id="btn"
      value="click"
      style="background-color: rgb(173, 245, 255)"/> -->
  <div id="error-message"></div>
  <div id="success-message"></div>

  <div class="container-fluid">
    <div class="h1">Add Records With PHP & Ajax</div>
    <!-- <div class="btnn"><button id="fetchData">Fetch Data</button></div> -->
    <form action="" id="form-data">

      <label for="name">Name</label><br />
      <input type="text" id="user_name" /><br />

      <label for="email">Email</label><br />
      <input type="email" id="user_email" /><br /><br />

      <input type="submit" id="save-button" value="Save">

    </form>
  </div>

  <table id="table" class="table table-striped">

    <tbody>
      <tr>
        <td id="table-data"></td>
      </tr>
    </tbody>
  </table>
</body>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">
  // $(document).ready(function () {
  //   console.log("we are using jquery");
  // $('selector').action(); //jquery syntex
  //   $("p").click(); //click on p
  //   $('p').click(function () {
  //     console.log('you clicked on p');
  //     $(this).hide()  // to use the this function when we click the a single element to hide
  //   });
  // $('p').hide(function(){
  //     console.log('hide paragraph')
  // });

  //   $("#para").hide(function () {
  //     console.log("hide paragraph 1");
  //   });

  //   $("#pa").hide(function () {
  //     console.log("hide paragraph 2");
  //   });

  //   $("#btn").click(function () {
  //     alert("Button clicked!");
  //   });
  // }); // do this when click on p

  $(document).ready(function () {
    function loadTable() {
      // $.ajax({
      //   url: "ajax-load.php",
      //   type: "POST",
      //   success: function (data) {
      //     $("#table-data").html(data);
      //   },
      // });
      $.ajax({
        url: "ajax-load.php",
        type: "POST",
        success: function (data) {
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); //Load Table Records

    // save button code start here
    //Insert new Records
    $('#save-button').on("click", function (e) {
      e.preventDefault();
      var user_name = $("#user_name").val();// create the user_name variable and take the id of name $user_name
      var user_email = $("#user_email").val();//  create the user_email variable and take the id of email $user_email

      if (user_name == "" || user_email == "") {
        $("#error-message").html('All Field Are Requried.').slideDown();
        // $("#success-message").slideUp();
      } else {
        $.ajax({

          url: "ajax-insert.php",
          type: "POST",
          data: { u_name: user_name, u_email: user_email }, //u_name is the key and the user_name is the value of key , u_email is the key and the user_email is the value of key                                                                                      
          success: function (data) {
            if (data == 1) {
              loadTable();
              $("#form-data").trigger("reset");
              $("#success-message").html("Records Save Successfully.").slideDown();
              $("#error-message").slideUp();
            }
            else {
              $("#error-message").html("Can't Save Records").slideDown();
              $("#success-message").slideUp();
            }

          }
        })

      }



      // In java script and jquery we use the id and class.

    });

    // Delete button code start here
    $(document).on("click", ".delete-btn", function () {
      var EmpId = $(this).data("id");
      var element = this;
      // alert(EmpId);

      $.ajax({
        url: "ajax-delete.php",
        type: "POST",
        data: { id: EmpId },
        success: function (data) {
          if (data == 1) {
            $(element).closest("tr").fadeOut();
            $("#success-message").html("Record Deleted").slideDown();
          } else {
            $("#error-message").html("Can't Delete Record").slideDown();
            $("#success-message").slideUp();
          }
        }

      });

    });
  });
</script>

</html>