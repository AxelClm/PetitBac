class Salle{
	constructor(id,nom,taille,placeRestante,categories){
		this.id = id;
		this.nom = nom;
		this.taille = taille;
		this.placeRestante = placeRestante;
		this.categories = categories;
		this.LastDraw=0;
	}
	drawSalle(divCible){
		this.salleContainer = document.createElement("div");
		this.salleContainer.className = "salleContainer";
		this.salleContainer.id ="salleC"+this.id;

		let salleHeader = document.createElement("div");
		salleHeader.className="salleHeader";
		this.salleContainer.appendChild(salleHeader);
			let premierCadre = document.createElement("div");
				let icone = document.createElement("div");
				icone.className="icone";
				premierCadre.appendChild(icone);
					let dessin = document.createElement("div");
					dessin.className="fas fa-users";
				icone.appendChild(dessin);
				this.salleNom = document.createElement("div");
				this.salleNom.className="salleName";
				this.salleNom.innerHTML=this.nom;
				premierCadre.appendChild(this.salleNom);		
				this.nbrPlace = document.createElement("div");
				this.nbrPlace.className="nbrPlace";
				this.nbrPlace.innerHTML=this.placeRestante+"/"+this.taille;
			premierCadre.appendChild(this.nbrPlace);
		salleHeader.appendChild(premierCadre);
		let traitRouge = document.createElement("div");
		traitRouge.className="salleHeaderUL"
		salleHeader.appendChild(traitRouge);
		this.salleContainer.appendChild(salleHeader)
		let salleMiddle = document.createElement("div")
		salleMiddle.className="salleMiddle";
			this.categoriesContainer = document.createElement("div");
			this.categoriesContainer.className="categoriesContainer";
			salleMiddle.appendChild(this.categoriesContainer);
		this.salleContainer.appendChild(salleMiddle);
		divCible.prepend(this.salleContainer);
		this.LastDraw = 1;
	}
	updateSalle(nom,taille,placeRestante,categories){
		if(this.nom != nom){
			this.nom = nom;
			this.salleNom.innerHTML=this.nom;
		}
		if(this.taille != taille || this.placeRestante != placeRestante){
			this.taille=taille;
			this.placeRestante = placeRestante;
			this.nbrPlace.innerHTML=this.placeRestante+"/"+this.taille;
		}
		if(this.categories != categories){
			//Redraw categories
		}
		this.LastDraw = 1;
	}
}

function initDiv(divCible){
	divCible.innerHTML = "";
	divCible.tabSalle = new Array();

}	
function showLoading(){
	if(document.querySelector(".loading") != null){
		document.querySelector(".loading").style.display="block";
		document.querySelector(".loading").style.visibility="visible";
	}
	else{
		var a = document.querySelector(".trigger");
		var b = document.createElement("img");
		b.src="data/loading.gif";
		b.className="loading";
		a.appendChild(b);
	}
	
}
function hideLoading(){
	document.querySelector(".loading").style.display="none";
	document.querySelector(".loading").style.visibility="hide";
}
function afficherSalleSelector(){
	var uT = document.querySelector("#salleSelectorUT");
	uT.style.opacity =1;
	uT.style.visibility="visible";
	var divCible = document.querySelector(".trigger");
	initDiv(divCible);
	showLoading();
	updateSalle(divCible);
}
function isAlreadyDraw(id,tab){
	if(tab[id]==null){
		return false;
	}
	return true;
}
function filtrage(item,index,arr){
	if(item != null){
		if(item.LastDraw == 1){
			item.LastDraw = 0;
		}
		else{
			arr[index] = null;
			let salle = document.querySelector("#"+item.salleContainer.id);
			this.removeChild(salle);
		}	
	}
}
function saveCoord(item){
	if(item!=null){
		let salle = document.querySelector("#"+item.salleContainer.id);
		item.lastCordX = salle.offsetLeft;
		item.lastCordY = salle.offsetTop;
		console.log(item.lastCordX);
		console.log(item.lastCordY);
		console.log("-----------");
	}
}
function moove(item){
	if(item != null){
		if(item.lastCordX != null && item.lastCordY !=null){
			let salle = document.querySelector("#"+item.salleContainer.id);
			let mX = item.lastCordX-salle.offsetLeft;
			let mY = item.lastCordY-salle.offsetTop;
			let tX = "translate("+mX+"px,"+mY+"px)";
			let tY = "translate(0px,0px)";
			salle.animate([{//from
               			transform: tX},
					{//to
						transform: tY}],600);
		}
	}
}
function updateSalle(divCible) {
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?getPublicSalles=',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
               hideLoading();
               let temptab = JSON.parse(xhr.responseText);
               for(var i =0; i<temptab.length;i++){
               	var tabSalle = divCible.tabSalle;
               	if(isAlreadyDraw(temptab[i]["IDSalle"],divCible.tabSalle)) {
               		divCible.tabSalle[temptab[i]["IDSalle"]].updateSalle(temptab[i]["nomSalle"],
               			temptab[i]["taille"],temptab[i]["placeRestante"],temptab[i]["categores"]);
               	}
               	else{
               		let salle = new Salle(temptab[i]["IDSalle"],temptab[i]["nomSalle"],
               			temptab[i]["taille"],temptab[i]["placeRestante"],temptab[i]["categores"]);
               		salle.drawSalle(divCible);
               		salle.salleContainer.animate([{//from
               			opacity: 0,visibility:"hidden"},
					{//to
						opacity: 1,visibility:"visible"}],500);
               		divCible.tabSalle[temptab[i]["IDSalle"]] = salle;
               	}
               }
               //on supprime les anciens div pour réorganiser
               divCible.tabSalle.forEach(filtrage,divCible);
               //on déplace les div par rapports a leurs ancienne coord
               divCible.tabSalle.forEach(moove);
               //on sauvegarde maintenant les coord
               divCible.tabSalle.forEach(saveCoord);
            }});
        xhr.send();
    }