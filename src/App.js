
import Posts from "./components/posts";
import Counter from "./components/counter";
import Route from "./routing/route";
import Header from "./components/header";
import Imager from "./components/imager";

const App = () => {

    return (
        <>
            <Header></Header>

            <Route path="/">
                <h5>Home</h5>
            </Route>
            <Route path="/Counter" >
                <h5>Counter</h5>
                <Counter></Counter>
            </Route>
            <Route path="/Messages">
                <h5>Feed</h5>
                <Posts></Posts>
            </Route>
            <Route path="/all">
                <h5>All</h5>
                <Counter></Counter>
                <Posts></Posts>
                <Imager></Imager>
            </Route>
            <Route path="/Imager">
                <Imager></Imager>
            </Route>
        </>
    );

};
export default App;


/*
import Posts from './components/posts.js';
import Sidebar from './components/sidebar.js';

const App = () => {

    return (
        <div id="react-base">
            <Sidebar></Sidebar>
            <Posts></Posts>
        </div>

    );

};
export default App;*/
