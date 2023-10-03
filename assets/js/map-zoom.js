    const element = document.getElementById('mobile-zoom-svg-1')
    const panzoom = Panzoom(element, {
       // Whether or not to transition the scale
        animate: false,
        // This option treats the Panzoom element's parent as a canvas.
        canvas: false,
        // Default cursor style for the element
        cursor: 'move',
        // Disable panning and zooming
        disablePan: false,
        disableZoom: false,
        // Pan only on the X or Y axes
        disableXAxis: false,
        disableYAxis: false,
        // <a href="https://www.jqueryscript.net/animation/">Animation</a> duration (ms)
        duration: 200,

        // CSS easing used for scale transition
        easing: 'ease-in-out',

        // An array of elements to exclude
        exclude: [],

        // Or add the CSS class to element that should be excluded
        excludeClass: 'panzoom-exclude',

        // Override the default handle start event here
        handleStartEvent: function (e) {
            e.preventDefault();
            e.stopPropagation();
        },

        // min/max scale factors
        maxScale: 4,
        minScale: 0.125,

        // CSS overflow property
        overflow: 'hidden',

        // Disable panning while the scale is equal to the starting value
        panOnlyWhenZoomed: false,

        // Enable panning during pinch zoom
        pinchAndPan: false,

        // When passing x and y values to .pan(), treat the values as relative to their current values
        relative: false,

        // Override the transform setter.
        // setTransform: setTransform,

        // X Value used to set the beginning transform
        startX: 0,

        // Y Value used to set the beginning transform
        startY: 0,

        // Scale used to set the beginning transform
        startScale: 1,

        // Step options
        step: 0.05,

        // Contain the panzoom element either inside or outside the parent.
        // "inside" | "outside"
        contain: null,

        // set touch-action on both the Panzoom element and its parent
        touchAction: 'none'
    });
 

    // enable mouse wheel
    const parent = element.parentElement
    
    parent.addEventListener('wheel', panzoom.zoomWithWheel);
 
    const elem = document.getElementById('mobile-zoom-svg-1');
   
    const zoomInButton = document.getElementById('zoom-in');
    const zoomOutButton = document.getElementById('zoom-out');
    const resetButton = document.getElementById('zoom-reset');

    elem.addEventListener('wheel', panzoom.zoomWithWheel);
 
    zoomInButton.addEventListener('click', panzoom.zoomIn)
    zoomOutButton.addEventListener('click', panzoom.zoomOut)
    resetButton.addEventListener('click', panzoom.reset)