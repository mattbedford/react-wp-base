import Link from "../../src/routing/link";

const Header = () => {
    // https://ncoughlin.com/posts/react-navigation-without-react-router
    return (
        <div className="ui secondary pointing menu">
            <Link href="/account/" className="item">
                Home
            </Link>
            <Link href="/account/counter/" className="item">
                Counter
            </Link>
            <Link href="/account/posts/" className="item">
                Posts
            </Link>
            <Link href="/account/image/" className="item">
                Image generator
            </Link>
        </div>
    );
};

export default Header;