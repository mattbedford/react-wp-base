import App from './App';


const {createRoot} = wp.element;

const container = document.getElementById('react-app');
const root = createRoot(container);
root.render(<App />);