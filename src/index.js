import App from './App';
import './styles.scss';

const {createRoot} = wp.element;

const container = document.getElementById('react-app');
if (container) {
    const root = createRoot(container);
    root.render(<App/>);
}