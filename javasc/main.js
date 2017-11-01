window.onload = function(){
	//
	var width = window.innerWidth;
	var height = window.innerHeight;
	var canvas = document.getElementById('canvas');
	
	canvas.setAttribute('width', width);
	canvas.setAttribute('height', height);
	canvas.style.left = "45%";
	canvas.style.top = "70%";
	canvas.style.position = "absolute";
	var render = new THREE.WebGLRenderer ({canvas: canvas});
	
	
	//
	var scene = new THREE.Scene();
	var camera = new THREE.PerspectiveCamera(65,window.innerWidth/window.innerHeight, 0.1, 10000);
	
	//var render = new THREE.WebGLRenderer({ antialias:true});
	//render.setSize( window.innerWidth, window.innerHeight );
	render.setClearColor( 0xffffff, 1 );
	//render.style:=bsClear;
	
	document.body.appendChild(render.domElement);
	
	camera.position.z = 800;
	function zoom(){
		camera.position.z = 700;
	};
	
	var light = new THREE.DirectionalLight( 0xfff7e8, 1 );
	scene.add(light);
	
	var amColor = "#faffe3";
	var amLight = new THREE.AmbientLight(amColor);
	scene.add(amLight);
	
	var manager = new THREE.LoadingManager();
	var loader = new THREE.ImageLoader(manager);
	
	var textureBody = new THREE.Texture();
	
	loader.load( 'model/earth.jpg', function ( image ) {
		textureBody.image = image;
		textureBody.needsUpdate = true;
	});	
	
	var meshes = [];
	
	var objLoader = new THREE.OBJLoader();
	
	objLoader.load( 'model/Earth.obj', function ( object ){
		console.log(object);
		object.traverse( function (child){
			if ( child instanceof THREE.Mesh ) {
				meshes.push(child);
			}
		});
		
		var body = meshes[0];
		
		//body.position.y = -40;
		body.position.z += 40;
		
		function rot(){
			body.rotation.y += 0.005;
			requestAnimationFrame(function(){rot();});
		};

		rot();
		scene.add(body);
		
		var bumpMapBody = new THREE.TextureLoader().load( 'model/earth.jpg' );
		
		body.material = new THREE.MeshPhongMaterial({
			map: textureBody,
			bumpMap: bumpMapBody,
			//specular: 0xfff7e8,
			bumpScale: 10
		});
		

		
	});
	/*var controls = new THREE.TrackballControls(camera);
	
	var rendering = function() {
		requestAnimationFrame(rendering);
		controls.update();
		render.render(scene, camera);
	};*/
	
	
	//var mesh = new THREE.Mesh(objLoader, body);

	
	var rendering = function() {
		//mesh.rotation.y += 1;
		render.render(scene, camera);
		requestAnimationFrame(rendering);
	};

	rendering();
};