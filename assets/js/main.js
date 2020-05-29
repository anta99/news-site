var baseUrl;
$(document).ready(function(){
    $(".resMenu").click(function(){
        menuSlide(1);
    })
    $("#closeBtn").click(function () {
        menuSlide(0);
    })
    $(window).on("resize",function(){
        if(this.innerWidth>991){
            if (!$(".menu").hasClass("d-none")){
                menuSlide(0);
            }
        }
    })
    menuSearch.addEventListener("input",function(){
        const searchQuery=this.value;
        if(searchQuery.length>=3){
            const postObj={
                searchQuery:searchQuery,
                search:true
            }
            ajaxReq("models/menuSearch.php",postObj,function(res){
                searchResultWrite(res);
                $("#searchResult").removeClass("d-none").addClass("d-block");
            })
            
        }
        else{
            $("#searchResult").removeClass("d-block").addClass("d-none");
        }
    })
    $(".searchBtn").click(function(){
        $(".searchMenu").removeClass("d-none");
        $(".searchMenu i").removeClass("fa-search").addClass("fa-times");
        $(".searchMenu i").removeClass("fa-search").addClass("fa-times");
    })
    $(".searchMenu i").click(function(){
        $(".searchMenu").addClass("d-none");
        $(".searchMenu i").addClass("fa-search").removeClass("fa-times");
    })
    //page=singleNews
    if(window.location.href.indexOf("page=singleNews")!=-1){
        baseUrl=window.location.href;
        $(".btnReply").click(function(){
            const parent = this.parentElement;
            commentFormPrint(parent);
        })
        $("#newCommentButton").click(function(){
            const parent=this.parentElement;
            commentFormPrint(parent);
        })
        $(".deleteComm").click(function(){
            console.log();
            const deleteObj={
                deleteId:this.dataset.commentid,
                deleteComm:true
            };
            ajaxReq("models/singleNews/deleteComments.php",deleteObj,function(res){
                console.log(res);
                location.reload();
            })
            
        })

    }
    //page=signIn
    else if (window.location.href.indexOf("page=signIn") != -1){
        console.log("Ovo je strana signIn.php");
        $("#logInForm").submit(function(e){
            console.log("Idemo log");
            let ok=true;
            const mail = document.querySelector("#logMail");
            const password = document.querySelector("#logPass");
            !inputCheck(emailRegex, mail) ? ok = false : ok = true;
            !inputCheck(passwordRegex, password) ? ok = false : ok = true;
            if(ok){
                return true;
            }
            e.preventDefault();
        })
    }
    //page=register
    else if (window.location.href.indexOf("page=register") != -1) {
        console.log("Ovo je strana register.php");
        $(".regBtn").click(function () {
            const firstName = document.querySelector("#regFirstName");
            const lastName = document.querySelector("#regLastName");
            const username = document.querySelector("#regUserName");
            const mail = document.querySelector("#regMail");
            const password = document.querySelector("#regPass");
            const confPassword = document.querySelector("#confPass");
            const terms = document.querySelector("#terms");
            let ok = true;
            !inputCheck(firstNameRegex, firstName) ? ok = false : ok = true;
            !inputCheck(lastNameRegex, lastName) ? ok = false : ok = true;
            !inputCheck(userNameRegex, username) ? ok = false : ok = true;
            !inputCheck(emailRegex, mail) ? ok = false : ok = true;
            !inputCheck(passwordRegex, password) ? ok = false : ok = true;
            if (confPassword.value != password.value) {
                ok = false;
                confPassword.classList.add("inputError");
                confPassword.nextElementSibling.innerHTML = "Molimo vas ispravno popunite ovo polje";
            }
            else {
                confPassword.nextElementSibling.innerHTML = "";
                confPassword.classList.remove("inputError");
            }
            if (!terms.checked) {
                ok = false;
                terms.nextElementSibling.innerHTML = "Molimo vas prihvatite uslove korišćenja";
            }
            else {
                terms.nextElementSibling.innerHTML = "";
            }
            ok ? console.log("Saljemo na back") : console.log("Nesto ne valja");
        })
        
    }
    //page=news
    else if (window.location.href.indexOf("page=news") != -1){
        console.log("Ovo je news page");
        $(".categoryNews a").click(function(){
            this.parentElement.classList.toggle("categoryActive");
            const activeCategories = [...document.querySelectorAll(".categoryActive a")];
            const categoriesIds=activeCategories.map(cat=>cat.dataset.catid);
            //console.log(categoriesIds);
            const filterObj={
                categoriesIds: categoriesIds,
                page:1,
                filter:"OK"
            };
            ajaxReq("models/news/filterNews.php",filterObj,function(res){
                printNews(res.news);
            });
            
        })
        // ajaxReq("models/news/filterNews.php", {filter:"OK"}, function (res) {
        //     if(res.news.length!=0){
        //         printNews(res.news);
        //     }
        //     else{
        //         console.log("Prazno");
        //     }
        // });
    }
    //index
    else{
        $.ajax({
            url: "models/mainPage/sliderNews.php",
            method:"GET",
            dataType:"json",
            success:function(res){
                sliderWrite(res);
            },
            error:function(xhr){
                console.log(xhr);
            }
        })
        console.log(window.location.href)
    }
})
//Regex
const firstNameRegex =/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/;
const lastNameRegex = /^[A-Z][a-z]{2,24}(\s[A-Z][a-z]{2,24})*$/;
const userNameRegex=/^[A-zčžćšđČŽĆŠĐ0-9\?\!\.]{3,30}$/;
const emailRegex = /^[a-z\.\!\?0-9]{4,40}\@[a-z0-9]{3,15}(\.[a-z0-9]{3,15})*\.[a-z]{2,3}$/;
const passwordRegex=/^[A-z0-9\.\?\,\s\!\@\#]{8,50}$/;
const userIcon = document.querySelector("#userIcon");
const menuSearch = document.querySelector("#menuSearch");
//Function declaration
let searchMenuWidth="75%";
function menuSlide(con){
    if(con){
        $(".menu").addClass("fixedMenu");
        $(".menu").removeClass("d-none");
        $("body").addClass("overflow-hidden");
    }
    else{
        $(".menu").addClass("d-none");
        $(".menu").removeClass("fixedMenu");
        $("body").removeClass("overflow-hidden");
    }
}
function sliderWrite(arr){
    const target = document.querySelector(".carousel-inner");
    let html = "";
    for (let i of arr) {
        html += `<div class="carousel-item">
            <div class="slika" style="background-image: linear-gradient(rgba(0,0,0,0.1),rgba(0,0,0,0.3)),url(assets/images/${i.slikaSrc});">
                <div class="naslov p-1 p-md-3 ml-md-5 p-lg-3">
                        <h5 class="cat badge badge-secondary">${i.category}</h5>
                        <h2><a href="index.php?page=singleNews&id=${i.id}">${i.naslov}</a></h2>
                        <div class="post-details">
                            <span><i class="fa fa-calendar"></i>
                            ${i.datum}</span>
                            <span><i class="fa fa-user mx-1"></i> ${i.author}</span>
                            <span><i class="fa fa-comment mx-1"></i>${i.commentCount}</span>
                        </div>
                    </div>
                </div>
            </div>`;
    }
    target.innerHTML = html;
    document.querySelectorAll(".carousel-item")[0].classList.add("active");
}
function commentFormPrint(parent){
    if (!parent.querySelector(".commentArea")) {
        let htmlForm = document.createElement("div");
        htmlForm.setAttribute("class", "col-12");
        htmlForm.innerHTML += `<form action="" id="komentarVest" name="komentarVest" method="POST">
        <textarea name="commentArea" class="commentArea" rows="10" placeholder="Ostavite komentar..."></textarea>
        <p class="text-danger"></p>
        <button class="btn buttonCustom commReply">Posalji</button>
        <button class="btn buttonCustom replyClose mb-3">Zatvori</button>
         </form>
    `;
        parent.appendChild(htmlForm);
        $(".commReply").click(function (e) {
            e.preventDefault();
            const reply = this.parentElement.querySelector(".commentArea");
            const newsId = document.querySelector("#newsId").value;
            const parentType = this.parentElement.parentElement.parentElement.getAttribute("id");
            const commentObj={};
            commentObj.newsId=newsId;
            commentObj.user=1;
            if(reply.value!=""){
                reply.nextElementSibling.innerHTML="";
                commentObj.reply=reply.value;
                if (parentType != "newComment") {
                    console.log("Novi komentar");
                    const parentCommentId = this.parentElement.parentElement.parentElement.parentElement.dataset.parentid;
                    commentObj.parentComment = parentCommentId;
                }
                commentObj.addComment = true;
                console.log(commentObj);
                ajaxReq("models/singleNews/addComment.php", commentObj, function (res) {
                    console.log(res);
                    printComments(res.comments,res.replies);
                    const url = baseUrl + "#relatedNews";
                    window.location = url;
                    document.querySelector(".comCount").innerHTML=res.commentsCount.count;
                    document.querySelector(".replyClose").click();
                });
            }
            else{
                reply.nextElementSibling.innerHTML = "Komentar ne sme biti prazan!";
            }
        })
        $(".replyClose").click(function (e){
            e.preventDefault();
            this.parentElement.parentElement.remove();
        })
    }
    else{
        console.log("Forma vec postoji");
    }
}
function inputCheck(regex,elem){
    if (!regex.test(elem.value)){
        elem.classList.add("inputError");
        elem.nextElementSibling.classList.remove("text-muted");
        elem.nextElementSibling.classList.add("text-danger");
        elem.nextElementSibling.innerHTML="Molimo vas da ispravno popunite ovo polje";
        return false;
    }
    else{
        elem.classList.remove("inputError");
        elem.nextElementSibling.classList.remove("text-danger");
        elem.nextElementSibling.classList.add("text-muted");
        elem.nextElementSibling.innerHTML = "";
        return true;
    }
}
function ajaxReq(url,postObj,success,error=function(xhr){console.log(xhr)}){
    $.ajax({
        url:url,
        method:"POST",
        dataType:"json",
        data:postObj,
        success:success,
        error:error
    })
}
function searchResultWrite(arr){
    const target = document.querySelector("#searchResult ul");
    let html="";
    if(arr.length!=0){
        for (let i of arr) {
            html += `<li><a href="index.php?page=singleNews&id=${i.id}" target="_blank">${i.naslov}</a></li>`;
        }
    }
    else{
        html += `<li><a href="#">Nazalost nema rezultata</a></li>`;
    }
    target.innerHTML=html;
}
function printComments(comments,replies){
    const commentSection = document.querySelector("#commentSection");
    let html="";
    for (let i of comments){
        html +=`
        <div class="commentHolder col-12" data-parentid="${i.id}">
            <div class="position-relative p-3 mb-2 comment">
                <span class="font-weight-bold">${i.username}</span>
                <span class="comDate position-absolute">${i.datum}</span>
                <p class="mt-3">${i.tekst}</p>
                <button class="btn buttonCustom btnReply">Odgovori</button>
            </div>`;
        if(!i.roditelj_id){
            const filteredReplies = replies.filter(reply => reply.roditelj_id==i.id);
            html +=`<div class="repliesHolder">`;
            for (let j of filteredReplies){
                html +=` 
                <div class="position-relative p-3 mb-2 comment reply">
                    <span class="font-weight-bold">${j.username}</span>
                    <span class="comDate position-absolute">${j.datum}</span>
                    <p class="mt-3">${j.tekst}</p>
                </div>`;
            }
            html +=`</div>`;
        }
        html+=`</div>`;
    }
    commentSection.innerHTML=html;
}
function printNews(arr){
    const target = document.querySelector("#newsContainer");
    let html="";
    if(arr.length!=0){
        for (let i of arr) {
            html += `
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1 p-lg-3 mb-2">
            <div class="card singleNewsContainer">
                <a href="index.php?page=singleNews&id=${i.id}">
                    <img class="card-img-top img" src="assets/images/${i.src}" alt="${i.naslov}" />
                </a>
                <span class="cat badge badge-secondary mt-4 ml-3">${i.category}</span>
                <div class="card-body">
                    <h2 class="card-title"><a href="index.php?page=singleNews&id=${i.id}">${i.naslov}</a></h2>
                    <div class="news-details my-2 text-black-50">
                        <span><i class="fa fa-calendar"></i>
                        ${i.datum}</span>
                        <span><i class="fa fa-user mx-1"></i> ${i.author}</span>
                    </div>
                    <p class="card-text text-truncate">${i.tekst}</p>
                    <a href="index.php?page=singleNews&id=${i.id}" class="btn btn-primary d-block readNews">Pročitaj još</a>
                </div>
            </div>
        </div>`;
        }
    }
    else{
        html+=`
        <div class="col-12 noNews text-center">
        <h3 class="">Nažalost nema vest za izabrane kategorije</h3>
        </div>`;
    }
    target.innerHTML=html;
}