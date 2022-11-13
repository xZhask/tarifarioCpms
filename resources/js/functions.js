window.addEventListener("load", () => {
  const contLoader = document.querySelector(".preloader");
  contLoader.style.opacity = 0;
  contLoader.style.visibility = "hidden";
});
const listadoUnidades = JSON.parse(ajaxFunction({ accion: "LISTAR_UNIDADES" }));
const nombreUnidades = listadoUnidades.map((unidad) => unidad.ipress);
let nivel = "";
function ajaxFunction(data) {
  let resultado;
  $.ajax({
    type: "POST",
    url: "App/controller/controller.php",
    data: data,
    async: false,
    error: () => {
      alert("Error occured");
    },
    success: (respuesta) => {
      resultado = respuesta;
    },
  });
  return resultado;
}
$(document).ready(function () {
  $("#ipress").autocomplete({
    source: nombreUnidades,
    select: (e, item) => {
      let unidad = item.item.value;
      let position = nombreUnidades.indexOf(unidad);
      nivel = listadoUnidades[position].nivel;
      $("#procedimiento").val("");
      let rptaAjax = ajaxFunction({
        accion: "LISTAR_PROCEDIMIENTOS",
        nvlipress: nivel,
        filtro: "",
      });
      $("#tbcpt").html(rptaAjax);
      $(".bg-dark").css("display", "none");
      document.getElementById("ipress").blur();
      $("#btnExcel").prop(
        "href",
        `resources/libraries/Excel/tarifario.php?nvl=${nivel}`
      );
    },
  });
});
const txtProcedimiento = document.querySelector("#procedimiento");
txtProcedimiento.addEventListener("keyup", FiltrarProcedimientos);

function FiltrarProcedimientos() {
  let filtro = $("#procedimiento").val();
  let data = {
    accion: "LISTAR_PROCEDIMIENTOS",
    filtro: filtro,
    nvlipress: nivel,
  };
  let rptaAjax = ajaxFunction(data);
  $("#tbcpt").html(rptaAjax);
}
posicionarBuscador();

$(window).scroll(function () {
  posicionarBuscador();
});

function posicionarBuscador() {
  var alturaHeader = $("header").outerHeight(true);
  if ($(window).scrollTop() >= alturaHeader) {
    $(".cont-search").addClass("fixed");
    $(".cont-table").css("margin-top", "135px");
  } else {
    $(".cont-search").removeClass("fixed");
    $(".cont-table").css("margin-top", "0");
  }
}
