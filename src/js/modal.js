
const btnModal = document.querySelectorAll(".btn-modal");
const btnModal2 = document.querySelectorAll(".btn-modal2");
const btnModal3 = document.querySelectorAll(".btn-modal3");
const btnModal4 = document.querySelectorAll(".btn-modal4");


function modal(e) {
    if (confirm("esta seguro que desea eliminar a este estudiante?")){
        return true;
    } else {
        e.preventDefault();
    }
};


function modal2(e) {
    if (confirm("esta seguro que desea eliminar a este profesor?")){
        return true;
    } else {
        e.preventDefault();
    }
};


function modal3(e) {
    if (confirm("esta seguro que desea eliminar a este usuario?")){
        return true;
    } else {
        e.preventDefault();
    }
};

function modal4(e) {
    if (confirm("esta seguro que desea cerrar sesion?")){
        return true;
    } else {
        e.preventDefault();
    }
};

    for (i= 0; i < btnModal.length; i++) {
    
        btnModal[i].addEventListener("click", function(e) {
            modal(e);
        });

    }
    
        for (i= 0; i < btnModal2.length; i++) {
    
            btnModal2[i].addEventListener("click", function(e) {
                modal2(e);
            });
        }

        for (i= 0; i < btnModal3.length; i++) {
    
            btnModal3[i].addEventListener("click", function(e) {
                modal3(e);
            });
        }

        for (i= 0; i < btnModal4.length; i++) {
    
            btnModal4[i].addEventListener("click", function(e) {
                modal4(e);
            });
        }