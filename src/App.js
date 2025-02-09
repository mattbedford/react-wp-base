
import Posts from "./components/posts";
import Counter from "./components/counter";
import Route from "./routing/route";
import Header from "./components/header";
import Imager from "./components/imager";
import DarkExample from "./components/table";

const App = () => {

    return (
        <>
            <Header></Header>

            <Route path="/account/">
                <h5>Home</h5>
                <p>Welcome to my Wordpress React app. Check out the subpages to see what it can do.</p>
                <p>And please note the URLs! This is custom routing within WP (and without 404 errors!)</p>
            </Route>
            <Route path="/account/counter/" >
                <h5>Counter</h5>
                <Counter></Counter>
            </Route>
            <Route path="/account/posts/">
                <h5>Posts</h5>
                <Posts></Posts>
            </Route>
            <Route path="/account/image/">
                <Imager></Imager>
            </Route>
            <Route path="/account/table/">
                <DarkExample></DarkExample>
            </Route>
        </>
    );

};
export default App;
