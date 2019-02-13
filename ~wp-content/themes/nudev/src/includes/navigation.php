<?php 
/**
 * Master Navigation Template
 *  See Partials for Mobile / Desktop
 */
 ?>
<div class="logo">
    <a href="<?php echo home_url(); ?>" title="Click to return to the Home Page">
        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 227.5 40.3"><style>.st0{fill:#FFF}</style><path class="st0" d="M10.4 28.9H4.5v3H10v2.8H4.5V40H1V26h9.4v2.9zM15.2 26.1c0 1-.9 1.8-1.9 1.8s-1.9-.8-1.9-1.8.9-1.8 1.9-1.8 1.9.8 1.9 1.8zM15 40h-3.4V29.3H15V40zM27 33.1v7h-3.4v-6c0-1.5-.4-2.2-1.5-2.2s-1.9.9-1.9 2.4V40h-3.4V29.3H20v1.4c.8-1.2 2-1.7 3.4-1.7 2.3 0 3.6 1.5 3.6 4.1zM38.2 32.4v5.2c0 .9.1 1.6.4 2.4h-3.3c-.2-.3-.3-.7-.4-1.1-.7 1-1.8 1.3-3.1 1.3-2.3 0-3.5-1.4-3.5-3.3 0-2.1 1.2-3.3 4.5-3.7l2-.2v-.5c0-1-.3-1.3-1.3-1.3s-1.4.4-1.5 1.2h-3.3c.1-2.3 1.8-3.5 4.8-3.5 3.4.1 4.7 1.4 4.7 3.5zm-4.6 2.9c-1.4.2-1.9.6-1.9 1.4 0 .7.4 1.1 1.2 1.1 1.1 0 1.9-.7 1.9-1.8v-.9l-1.2.2zM50.2 33.1v7h-3.4v-6c0-1.5-.4-2.2-1.5-2.2s-1.9.9-1.9 2.4V40H40V29.3h3.2v1.4c.8-1.2 2-1.7 3.4-1.7 2.3 0 3.6 1.5 3.6 4.1zM62.1 32l-2.9 1.1c-.3-1-1-1.5-2-1.5-1.3 0-2.2.9-2.2 3 0 2 .9 3 2.3 3 1.2 0 1.8-.7 2.1-1.7l2.9 1.1c-.9 1.9-2.6 3.2-5.2 3.2-3.5 0-5.6-2.3-5.6-5.6s2.2-5.7 5.6-5.7c2.5.1 4.1 1.2 5 3.1zM73.4 34.9v.6h-7.3c.1 1.5 1 2.3 2.3 2.3 1.1 0 1.8-.6 2.3-1.3l2.6 1.3c-1 1.6-2.7 2.6-5.1 2.6-3.5 0-5.6-2.4-5.6-5.6 0-3.3 2-5.6 5.4-5.6 3.4-.2 5.4 2.1 5.4 5.7zm-7.3-1.4H70c-.1-1.5-.8-2.1-2-2.1-1 0-1.8.6-1.9 2.1zM91.3 32.8c0 5.5-3.6 7.2-7 7.2H79V26h4.7c4 0 7.6 1.8 7.6 6.8zm-8.8-3.9v8.4h1.8c1.6 0 3.4-.8 3.4-4.4 0-2.5-1.1-4-3.9-4h-1.3zM96.5 26.1c0 1-.9 1.8-1.9 1.8s-1.9-.8-1.9-1.8.9-1.8 1.9-1.8 1.9.8 1.9 1.8zM96.2 40h-3.4V29.3h3.4V40zM104.6 40h-4.2L97 29.3h3.7l1.8 8.1 1.9-8.1h3.6L104.6 40zM112.3 26.1c0 1-.9 1.8-1.9 1.8-1 0-1.9-.8-1.9-1.8s.9-1.8 1.9-1.8c1 0 1.9.8 1.9 1.8zm-.2 13.9h-3.4V29.3h3.4V40zM123.1 30.7l-1.6 1.8c-.9-.7-1.8-1.1-2.9-1.1-1.1 0-1.5.3-1.5.8 0 .6.3.7 2.5 1.2 2.5.5 3.7 1.5 3.7 3.5s-1.8 3.5-5 3.5c-2.5 0-4-.7-5.3-1.8l1.6-1.9c1.1 1 2.2 1.3 3.3 1.3 1.3 0 1.9-.3 1.9-.9s-.2-.8-2.4-1.2c-2.5-.5-3.8-1.5-3.8-3.3 0-2.2 2.1-3.4 4.8-3.4 2.1-.2 3.7.5 4.7 1.5zM128.2 26.1c0 1-.9 1.8-1.9 1.8s-1.9-.8-1.9-1.8.9-1.8 1.9-1.8 1.9.8 1.9 1.8zm-.3 13.9h-3.4V29.3h3.4V40zM140.8 34.7c0 3.4-2.2 5.6-5.8 5.6-3.7 0-5.8-2.3-5.8-5.6s2.2-5.6 5.8-5.6c3.6-.1 5.8 2.4 5.8 5.6zm-8-.1c0 2 .8 3.1 2.3 3.1 1.4 0 2.2-1 2.2-3.1s-.9-3-2.2-3c-1.4.1-2.3 1-2.3 3zM152.3 33.1v7h-3.4v-6c0-1.5-.4-2.2-1.5-2.2s-1.9.9-1.9 2.4V40h-3.4V29.3h3.2v1.4c.8-1.2 2-1.7 3.4-1.7 2.3 0 3.6 1.5 3.6 4.1z"/><g><path class="st0" d="M222 17l3.7-8.3c.7-1.6 1-2 1.7-2.2v-.6h-3.9v.6c1.3.3 1.4.9.8 2.3l-1.5 3.6-1.8-4.1c-.4-.9-.3-1.5 1-1.6v-.6h-5.2v.6c.6.2.9.4 1.4 1.5l3.3 7.1-.6 1.2c-.3.7-.6 1.2-.9 1.5-.2-.8-.7-1.2-1.4-1.2s-1.3.5-1.3 1.4.8 1.6 1.6 1.6c1.3 0 2.1-.6 3.1-2.8m-5.3-2.5l-.3-.6c-.5.2-1 .4-1.4.4-.9 0-1.2-.5-1.2-1.1v-6h2.5V6.1h-2.5V4.3h-.4l-3.6 2.3v.6h1.4v6.5c0 1.3.7 2 2.2 2 1.2-.1 2.4-.4 3.3-1.2m-7.5.3c-1.2-.2-1.4-.4-1.4-1.5V5.7h-1l-2.9 1.9V8h1.4v5.3c0 1.1-.2 1.3-1.4 1.5v.6h5.3v-.6zm-2.9-10.6c.8 0 1.5-.7 1.5-1.5s-.6-1.4-1.4-1.4c-.9 0-1.5.7-1.5 1.5.1.8.6 1.4 1.4 1.4m-3.4 8.4c0-1.8-1.5-2.4-3-2.9-1.4-.5-2.4-.7-2.4-1.8 0-.6.4-1.1 1.2-1.1 1 0 1.9.6 3 1.8l.5-.2-.7-2.4h-.3l-.4.3c-.6-.2-1.2-.4-1.9-.4-2.1 0-3.5 1.2-3.5 3s1.5 2.4 3 2.8c1.4.5 2.4.7 2.4 1.8 0 .7-.5 1.2-1.4 1.2-1.3 0-2.3-.9-3.6-2.4l-.5.2.8 3.1h.3l.6-.4c.7.3 1.4.5 2.2.5 2 0 3.7-1.2 3.7-3.1m-10.3 2.3c-1.3-.2-1.5-.5-1.5-1.7V9.1c.4-.7.8-1.2 1.2-1.6 0 .8.5 1.3 1.2 1.3s1.3-.5 1.3-1.6c0-.9-.5-1.4-1.4-1.4-1 0-1.7.8-2.4 2v-2h-.9l-2.9 1.9v.4h1.4v5.3c0 1.1-.2 1.4-1.3 1.5v.6h5.3v-.6zm-12.5-5.4c0-1.6.7-2.6 2-2.6.9 0 1.5.7 1.7 1.9l-3.7 1.3v-.6m6.2 4.2l-.5-.4c-.5.6-1.3 1-2.3 1-1.8 0-2.9-1.4-3.2-3.2l5.9-2c-.1-2.1-1.7-3.2-3.6-3.2-2.8 0-4.8 2.2-4.8 5 0 2.7 1.8 4.8 4.8 4.8 1.9 0 3.1-.8 3.7-2M176 8.9c.7-1.6 1-2 1.7-2.2v-.6h-3.9v.6c1.3.3 1.4.9.8 2.3l-1.5 3.6-1.9-4.2c-.4-.9-.3-1.5 1-1.6v-.6H167v.6c.6.2.9.4 1.4 1.5l3.4 7.3h1l3.2-6.7zm-9.1 6c-1.2-.2-1.4-.4-1.4-1.5V5.8h-1l-2.9 1.9v.4h1.4v5.3c0 1.1-.2 1.3-1.4 1.5v.6h5.3v-.6zm-2.8-10.6c.8 0 1.5-.7 1.5-1.5s-.6-1.4-1.4-1.4c-.9 0-1.5.7-1.5 1.5s.6 1.4 1.4 1.4m-10 10.6c-1.1-.2-1.3-.4-1.3-1.5V8.8c1-.9 1.8-1.3 2.5-1.3 1 0 1.2.5 1.3 1.4v4.5c0 1.1-.2 1.4-1.3 1.5v.6h5.1v-.6c-1.1-.2-1.3-.4-1.3-1.5V8.7c0-1.6-.7-2.7-2.7-2.7-1.2 0-2.4.8-3.6 1.8V5.9h-.9L149 7.8v.4h1.4v5.3c0 1.1-.2 1.4-1.3 1.5v.6h5.1l-.1-.7zM132.4 3.3v5.9c0 3.8 2 6.5 7.1 6.5s7.1-2.7 7-6.5V4.4c0-2.3.6-2.9 1.8-3.2V.6h-4.8v.6c1.1.3 1.8.9 1.8 3.2v4.8c0 3.4-1.8 4.9-5.1 4.9s-5.1-1.5-5.1-4.9v-6c0-1.5.4-1.8 1.7-1.9V.6h-6v.7c1.2.3 1.6.5 1.6 2M116.6 15c-1.1-.2-1.3-.4-1.3-1.5V8.9c1-.9 1.8-1.3 2.5-1.3 1 0 1.2.5 1.3 1.4v4.5c0 1.1-.2 1.4-1.3 1.5v.6h5.1V15c-1.1-.2-1.3-.4-1.3-1.5V8.8c0-1.6-.7-2.7-2.7-2.7-1.2 0-2.4.8-3.6 1.8V6h-.9l-2.9 1.9v.4h1.4v5.3c0 1.1-.2 1.4-1.3 1.5v.6h5.1l-.1-.7zm-7.9 0c-1.3-.2-1.5-.5-1.5-1.7V9.2c.4-.7.8-1.2 1.2-1.6 0 .8.5 1.3 1.2 1.3s1.3-.5 1.3-1.6c0-.9-.5-1.4-1.4-1.4-1 0-1.7.8-2.4 2v-2h-.9l-2.9 1.9v.4h1.4v5.3c0 1.1-.2 1.4-1.3 1.5v.6h5.3V15zM96.3 9.7c0-1.6.7-2.6 2-2.6.9 0 1.5.7 1.7 1.9l-3.7 1.3v-.6m6.2 4.2l-.5-.4c-.5.6-1.3 1-2.3 1-1.8 0-2.9-1.4-3.2-3.2l5.9-2c-.1-2.1-1.7-3.2-3.6-3.2C96 6.1 94 8.3 94 11s1.8 4.8 4.8 4.8c1.9 0 3-.8 3.7-1.9m-9.2.9l-.3-.7c-.5.2-1 .4-1.4.4-.9 0-1.2-.5-1.2-1.1v-6h2.5V6.3h-2.5V4.5H90l-3.6 2.3v.6h1.4v6.5c0 1.3.7 2 2.2 2 1.3 0 2.4-.4 3.3-1.1m-7.5-2c0-1.8-1.5-2.4-3-2.9-1.4-.5-2.4-.7-2.4-1.8 0-.6.4-1.1 1.2-1.1 1 0 1.9.6 3 1.8l.5-.2-.8-2.5H84l-.4.3c-.6-.2-1.2-.4-1.9-.4-2.1 0-3.5 1.2-3.5 3s1.5 2.4 3 2.8c1.4.5 2.4.7 2.4 1.8 0 .7-.5 1.2-1.4 1.2-1.3 0-2.3-.9-3.6-2.4l-.5.2.8 3.1h.3l.6-.4c.7.3 1.4.5 2.2.5 2.2.1 3.8-1.1 3.8-3m-15.2.4c0-1 .5-1.5 2.8-2.1V14c-.6.4-1 .6-1.5.6-.9 0-1.3-.5-1.3-1.4m4.3 2.6c.9 0 1.8-.4 2.4-.8l-.2-.6c-1 .2-1.3 0-1.3-.6V8.5c0-1.6-.7-2.4-2.9-2.4-2.5 0-4.4 1.4-4.4 2.6 0 .6.4 1.1 1.1 1.1.8 0 1.2-.5 1.3-1.1.1-.6-.1-1.1-.4-1.3.5-.2 1-.4 1.5-.4.9 0 1.3.3 1.3 1.1v2c-3.5.9-5.2 1.7-5.2 3.5 0 1.4.9 2.2 2.4 2.2.9 0 2-.4 2.9-1.1.2.7.7 1.1 1.5 1.1m-14-6.1c0-1.6.7-2.6 2-2.6.9 0 1.5.7 1.7 1.9l-3.7 1.3v-.6m6.2 4.2l-.5-.4c-.5.6-1.3 1-2.3 1-1.8 0-2.9-1.4-3.2-3.2l5.9-2c-.1-2.1-1.7-3.2-3.6-3.2-2.8 0-4.8 2.2-4.8 5 0 2.7 1.8 4.8 4.8 4.8 1.9 0 3-.8 3.7-2m-15.8 1.2c-1.1-.1-1.3-.4-1.3-1.5V9c1-.9 1.7-1.3 2.5-1.3 1 0 1.2.5 1.3 1.4v4.5c0 1.1-.2 1.4-1.3 1.5v.6h5.1v-.6c-1.1-.2-1.3-.4-1.3-1.5V8.9c0-1.6-.7-2.7-2.7-2.7-1.2 0-2.4.7-3.6 1.7V0h-.7L46 2.1v.4h1.4v11.1c0 1.1-.2 1.4-1.3 1.5v.6h5.1l.1-.6zm-5.7-.2l-.3-.6c-.5.2-1 .4-1.4.4-.9 0-1.2-.5-1.2-1.1v-6h2.5V6.5h-2.5V4.7h-.4L38.7 7v.6h1.4v6.5c0 1.3.7 2 2.2 2 1.2-.1 2.3-.5 3.3-1.2m-9.7.3c-1.3-.2-1.5-.5-1.5-1.7V9.4c.4-.7.8-1.2 1.2-1.6 0 .8.5 1.3 1.2 1.3s1.3-.5 1.3-1.6c0-.9-.5-1.4-1.4-1.4-1 0-1.7.8-2.4 2v-2h-.9L30.5 8v.4h1.4v5.3c0 1.1-.2 1.4-1.3 1.5v.6h5.3v-.6zm-14.3-5.1c0-1.8.8-2.9 2.4-2.9 2.1 0 2.7 2.6 2.7 4.9 0 1.8-.8 2.9-2.4 2.9-2.1 0-2.7-2.6-2.7-4.9m7.6.9c0-2.6-1.8-4.8-4.9-4.8-3.2 0-5.1 2.3-5.1 5 0 2.6 1.8 4.8 4.9 4.8 3.1 0 5.1-2.3 5.1-5m-13-6.2c0-2.3.6-2.9 1.8-3.2V1h-4.8v.6c1.1.3 1.8.9 1.8 3.2v7L4.9 1.6C4.3 1 4.1 1 3.7 1H0v.6c.8.1 1.3.4 2.2 1.3.3.2.6.6.6 1.1v7.9c0 2.3-.6 2.9-1.8 3.2v.6h4.8v-.6C4.7 14.9 4 14.3 4 12V4.5l11.4 11.4h.8V4.8z"/></g></svg>
    </a>
</div>

<input type="checkbox" id="neu__navicon">
<label for="neu__navicon" id="neu__navicon-label"></label>

<?php 
    include(__DIR__ . '/partials/nav.mobile.php');
    include(__DIR__ . '/partials/nav.desktop.php');
 ?>