const Header = () => {
    // https://ncoughlin.com/posts/react-navigation-without-react-router
    return (
        <div className="ui secondary pointing menu">
            <a href="/" className="item">
                Accordion
            </a>
            <a href="/color-select" className="item">
                Color Select
            </a>
            <a href="/translate" className="item">
                Translate
            </a>
            <a href="/search" className="item">
                Wiki Search
            </a>
            <a href="/all" className="item">
                All Widgets
            </a>
        </div>
    );
};

export default Header;