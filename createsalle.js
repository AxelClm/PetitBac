function addCategorie(){
	if(this.a == null){
		this.a=1;
	}
	this.a = this.a +1;
	let newCat = document.createElement('div');
	let caso = document.createElement('input');
	caso.type ="text";
	caso.value="Catégorie "+this.a;
	newCat.appendChild(caso);
	let bouton = document.createElement('input');
	bouton.type="button";
	bouton.value ="x";
	bouton.b = this.a;
	bouton.onclick = function(){removeCategorie(this.b);};
	newCat.appendChild(bouton);
	newCat.id="Cat"+this.a+"";

	let point = document.getElementById("categorie");
	point.appendChild(newCat);

	//return a; pour $cate

}

function removeCategorie(b){
	console.log(b);
	let aenlever = document.getElementById("Cat"+b+"");
	aenlever.remove();
	//return a-1; pour $cate
}