
import Posts from "./components/posts";
import Counter from "./components/counter";
import Route from "./routing/route";
import Header from "./components/header";
import Imager from "./components/imager";

const App = () => {

    return (
        <>
            <Header></Header>

            <Route path="/account/">
                <h5>Home</h5>
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
        </>
    );

};
export default App;
