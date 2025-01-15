
import Feed from "./pages/feed";
import Counter from "./components/counter";
import Route from "./routing/route";
import Header from "./components/header";

const App = () => {

    return (
        <>
            <Header></Header>

            <h1>The App component</h1>
            <Route path="Counter" >
                <Counter></Counter>
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
