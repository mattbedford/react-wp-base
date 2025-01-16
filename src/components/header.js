import Link from "../../src/routing/link";

const Header = () => {
    // https://ncoughlin.com/posts/react-navigation-without-react-router
    return (
        <div className="ui secondary pointing menu">
            <Link href="/" className="item">
                Root
            </Link>
            <Link href="/Counter" className="item">
                Counter
            </Link>
            <Link href="/Messages" className="item">
                Messages
            </Link>
            <Link href="/Imager" className="item">
                Image of the count
            </Link>
        </div>
    );
};

export default Header;