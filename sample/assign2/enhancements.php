<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link rel="icon" href="images/Logo_icon.png" type="image/x-icon">
    <title>Enhancement</title>
</head>

<body>
    <?php include 'includes/header.inc'; ?>

    <!--Back to top button-->
    <div>
        <a href="#" title="Back to top">
            <img id="btt" src="images/backtop.png" alt="Back to top button">
        </a>
    </div>

    <div id="sliding">
        <div id="slide_pos">
            <div id="slide_close_run">
                <img src="images/hung.png" alt="Enhancement page's slider">
                <img src="images/duc.jpg" alt="Enhancement page's slider">
                <img src="images/an.jpg" alt="Enhancement page's slider">
                <img src="images/khanh.jpg" alt="Enhancement page's slider">
            </div>
        </div>
    </div>

    <h1 id="enhance_title">Enhancements</h1>
    <section id="enhance_expla">
        <details>
            <summary id="sum_nav">Navigation bar</summary>
            <p class="en_pos">Position for enhancement application: file <a href="#active">style.css</a></p>
            <ol>
                <li>
                    <p>The name of the active page is separated from the others.</p>
                    <h4 class="expla">Explanation</h4>
                    <p class="language HTML">HTML</p>
                    <img src="images/active_page_html.png" alt="Active Page HTML">
                    <p class="language CSS">CSS</p>
                    <img src="images/active_page_css.png" alt="Active Page CSS">
                </li>
                <li>
                    <p>When the web is seen in mobile size, the navigation bar would be collapsed to be more friendly to the users.</p>
                    <h4 class="expla">Explanation</h4>
                    <p class="language HTML">HTML</p>
                    <img src="images/mobile_page_html.png" alt="Active Page HTML">
                    <p class="language CSS">CSS</p>
                    <h4>Change state according to the width of the screen:</h4>
                    <img src="images/mobile_page_css(1).png" alt="Active Page CSS">
                    <h4>Justify the open-close button when the navigation bar is not open:</h4>
                    <img src="images/mobile_page_css(2).png" alt="Active Page CSS">
                    <h4>Justify the open-close button when the navigation bar is open:</h4>
                    <img src="images/mobile_page_css(3).png" alt="Active Page CSS">
                    <h4>Justify the menu when the navigation bar is open:</h4>
                    <img src="images/mobile_page_css(4).png" alt="Active Page CSS">
                </li>
            </ol>
        </details>

        <details>
            <summary id="sum_slide">Sliding pictures</summary>
            <p class="en_pos">Position for enhancement application: file <a href="#sliding">style.css</a></p>
            <ol>
                <li>
                    <p>The pictures at the top of the page automatically slide to the left, respectively.</p>
                    <h4 class="expla">Explanation</h4>
                    <p class="language HTML">HTML</p>
                    <img src="images/sliding_html.png" alt="Sliding Effect HTML">
                    <p class="language CSS">CSS</p>
                    <img src="images/sliding_css.png" alt="Sliding Effect CSS">
                </li>
            </ol>
        </details>

        <details>
            <summary id="sum_backtop">Back to top button</summary>
            <p class="en_pos">Position for enhancement application: all pages - edited in file <a href="#btt">style.css</a></p>
            <ol>
                <li>
                    <p>The button with an upper arrow is located at the right bottom, users can move to the top of the page when the button is clicked.</p>
                    <h4 class="expla">Explanation</h4>
                    <p class="language HTML">HTML</p>
                    <img src="images/backtop_html.png" alt="Back To Top Button HTML">
                    <p class="language CSS">CSS</p>
                    <img src="images/backtop_css.png" alt="Back To Top Button CSS">
                </li>
            </ol>
        </details>
    </section>

    <?php include 'includes/footer.inc'; ?>
</body>

</html>