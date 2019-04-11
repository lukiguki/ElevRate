window.onload = start;

function start() {
    const losen = document.querySelector("#losen");
    const replos = document.querySelector("#replos");

    /* så fort vi skriver något i rutorna */
    losen.addEventListener("change", valideraLosen);
    replos.addEventListener("keyup", valideraLosen);

    function valideraLosen() {
        if (losen.value != replos.value) {
            replos.setCustomValidity("Lösenorden stämmer inte!");
        } else {
            replos.setCustomValidity('');
        }
    }
}