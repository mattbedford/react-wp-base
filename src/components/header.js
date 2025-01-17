import Link from "../../src/routing/link";

const Header = () => {
    // https://ncoughlin.com/posts/react-navigation-without-react-router
    return (
        <div className="ui secondary pointing menu">
            <Link href="/account/" className="item">
                Root
            </Link>
            <Link href="/account/counter/" className="item">
                Counter
            </Link>
            <Link href="/account/posts/" className="item">
                Messages
            </Link>
            <Link href="/account/image/" className="item">
                Image of the count
            </Link>
        </div>
    );
};

export default Header;