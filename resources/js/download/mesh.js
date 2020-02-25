import * as THREE from 'three/build/three.module'
import Stats from 'three/examples/jsm/libs/stats.module'
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls'
import {FBXLoader} from 'three/examples/jsm/loaders/FBXLoader'
import * as $ from "jquery";

let camera, scene, renderer;
let geometry, material, mesh;

function getWindowMesh() {
    let asset_id = $("#asset").attr('data-id')
    let div = $("#mesh")

    KTApp.block(div, {
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        size: 'lg',
        message: 'Chargement du modèle 3D...'
    })

    $.get('/api/download/'+asset_id+'/loadMesh')
        .done(function (data) {
            KTApp.unblock(div)
            init('https://download.trainznation.eu/asset/fbx/'+data.data.id+'/'+data.data.id+'.fbx')
        })
}

function init(fbxfile) {
    let container = document.querySelector('#mesh')

    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 2000);
    camera.position.set(100, 200, 300)

    scene = new THREE.Scene()
    scene.background = new THREE.Color(0xa0a0a0);
    scene.fog = new THREE.Fog(0xa0a0a0, 200, 1000);

    let light = new THREE.HemisphereLight(0xffffff, 0x444444);
    light.position.set(0, 200, 0);
    scene.add(light);

    light = new THREE.DirectionalLight(0xffffff);
    light.position.set(0, 200, 100);
    light.castShadow = true;
    light.shadow.camera.top = 180;
    light.shadow.camera.bottom = -100;
    light.shadow.camera.left = -120;
    light.shadow.camera.right = 120;
    scene.add(light);

    let mesh = new THREE.Mesh(new THREE.PlaneBufferGeometry(2000, 2000), new THREE.MeshPhongMaterial({
        color: 0x999999,
        depthWrite: false
    }));
    mesh.rotation.x = -Math.PI / 2;
    mesh.receiveShadow = true;
    scene.add(mesh);

    let grid = new THREE.GridHelper(2000, 20, 0x000000, 0x000000);
    grid.material.opacity = 0.2;
    grid.material.transparent = true;
    scene.add(grid);

    let loader = new FBXLoader()
    loader.load(fbxfile, function (object) {
        mixer = new THREE.AnimationMixer(object)
        let action = mixer.clipAction(object.animations[0])
        action.play()

        object.traverse(function (child) {
            if (child.isMesh()) {
                child.castShadow = true
                child.receiveShadow = true
            }
        })

        scene.add(object)
        renderer = new THREE.WebGLRenderer({antialias: true});
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.shadowMap.enabled = true;
        container.appendChild(renderer.domElement);

        let controls = new OrbitControls(camera, renderer.domElement);
        controls.target.set(0, 100, 0);
        controls.update();

        window.addEventListener('resize', onWindowResize, false);

        // stats
        let stats = new Stats();
        container.appendChild(stats.dom);
    })
}

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize(window.innerWidth, window.innerHeight);

}


getWindowMesh()
