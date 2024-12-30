import Counter from './components/counter.js';
import Fetcher from './components/fetcher.js';
import Tester from './components/tester.js';

const App = () => {

    return (
        <div>

            <h1>React Settings Page</h1>
            <p>Our react settings page is now ready.</p>
            <Counter></Counter>
            <Fetcher></Fetcher>
            <Tester></Tester>
        </div>

    );

};
export default App;