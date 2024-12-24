const {render} = wp.element;
import App from './App';

if (document.getElementById('react-app')) {
    render(<App/>, document.getElementById('react-app'));
}