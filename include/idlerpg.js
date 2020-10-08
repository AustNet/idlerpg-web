// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("mobilenav");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else { 
      x.className = x.className.replace(" w3-show", "");
    }
  }

// responsive image map - https://stackoverflow.com/questions/13321067/dynamically-resizing-image-maps-and-images/22056171
class ResponsiveImageMap {
    constructor(map, img, width) {
        this.img = img;
        this.originalWidth = width;
        this.areas = [];

        for (const area of map.getElementsByTagName('area')) {
            this.areas.push({
                element: area,
                originalCoords: area.coords.split(',')
            });
        }

        window.addEventListener('resize', e => this.resize(e));
        this.resize();
    }

    resize() {
        const ratio = this.img.offsetWidth / this.originalWidth;

        for (const area of this.areas) {
            const newCoords = [];
            for (const originalCoord of area.originalCoords) {
                newCoords.push(Math.round(originalCoord * ratio));
            }
            area.element.coords = newCoords.join(',');
        }

        return true;
    };
}

document.addEventListener('DOMContentLoaded', function() {
  var map = document.getElementById('myMapId');
  var image = document.getElementById('myImageId');
  setTimeout(() => { new ResponsiveImageMap(map, image, 800); }, 2000);
  
})
