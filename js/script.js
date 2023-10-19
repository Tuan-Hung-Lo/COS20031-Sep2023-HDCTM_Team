const spwrapper = document.querySelector(".sp-card-wrapper");
arrowbtns = document.querySelectorAll (".sp-slide-container .arrow-btn");
firstCard = spwrapper.querySelectorAll(".sp-card")[0];

let isDrafStart = false, prevPageX, prevScrolleft;
let firstCardWidth = firstCard.clientWidth + 15;

//arrowbtns.forEach(btn => {
//    btn.addEventListener("click", () => {
//        carousel.scrollLeft += btn.id == "left"?;
//    })
//});

const dragStart = (e) => {
    isDrafStart = true;
    prevPageX = e.pageX;
    prevScrolleft = spwrapper.scrollLeft;
}

const dragging = (e) => {
    if(!isDrafStart) return;
    e.preventDefault();
    let positionDiff = e.pageX - prevPageX;
    spwrapper.scrollLeft = prevScrolleft - positionDiff;
}

const dragStop = () => {
    isDrafStart = false;
}

spwrapper.addEventListener("mousedown", dragStart);
spwrapper.addEventListener("mousemove", dragging);
spwrapper.addEventListener("mouseup", dragStop);



