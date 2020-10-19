function findStartV(grafo){
   var v=[]; //contiene todas las aristas
   var start=0;
   var ini=grafo.nodes[0].value;
   for(var i=0;i<grafo.vertices;i++){
     var aux=0;
     for(var j=0;j<grafo.nodes[i].edges.length;j++){
        aux+=1;
     }
     if(aux%2!=0){
       return grafo.nodes[i].value;
     }
   }
   return 0;
}

function hamiltonian(vertexes, start) { //vertexes es el array nodes de grafo, start usar funcion findStartV(grafo)
    let n = vertexes.length;
    let paths = [[start]];
    while(paths.length>0) {
        let tempPath = [];
        for(let path of paths){
            const nextSteps = vertexes.find(({value}) => value == path[path.length-1]).edges.filter(v => !path.includes(v));
            if(!nextSteps.length) continue;
            else if(path.length == n-1) return [...path, nextSteps[0]];
            else nextSteps.forEach(step => tempPath.push([...path,step]));
        }
        paths = tempPath;
    }
}
