console.log(122);


const searchClient=async ()=>{
    let keyword= document.querySelector('#keyword').value
    // let coursContanaire=document.querySelector("#coursContanaire")
    if (!keyword) {
      console.log("Veuillez entrer un mot-clé.");
        return;
    }

    // console.log(keyword);
    
 
    try {
        // if (keyword.length >= 3) {
            const req = await fetch(`http://localhost/ESSEMLALI-Bank/search-clien?keyword=${encodeURIComponent(keyword)}`);
            
            if (!req.ok) {
                throw new Error(`Erreur HTTP : ${req.status}`);
            }
    
            const response = await req.json();
            console.log(response); 
        // }
    } catch (error) {
        console.log("Une erreur s'est produite lors de la recherche :", error.message);
    }
    
    
    
 }
 
 
 
 