
import Posts from "./components/posts";
import Counter from "./components/counter";
import Route from "./routing/route";
import Header from "./components/header";
import Imager from "./components/imager";
import DarkExample from "./components/table";
import i18n from "i18next";
import { useTranslation, initReactI18next } from "react-i18next";

i18n
    .use(initReactI18next) // passes i18n down to react-i18next
    .init({
        // the translations
        // (tip move them in a JSON file and import them,
        resources: {
            en: {
                translation: {
                    "welcome-text-1": "Welcome to React and react-i18next"
                }
            },
            it: {
                translation: {
                    "welcome-text-1": "Benvenuto in React e react-i18next"
                }
            }
        },
        lng: "it", // if you're using a language detector, do not define the lng option
        fallbackLng: "en",

        interpolation: {
            escapeValue: false // react already safes from xss => https://www.i18next.com/translation-function/interpolation#unescape
        }
    });

const App = () => {
    const { t } = useTranslation();

    return (
        <>
            <Header></Header>

            <Route path="/account/">
                <div className="main-app account">
                    <h5>Home</h5>
                    <p>{t('welcome-text-1') }</p>
                    <p>And please note the URLs! This is custom routing within WP (and without 404 errors!)</p>
                </div>
            </Route>
            <Route path="/account/counter/">
                <div className="main-app counter">
                    <h5>Counter</h5>
                    <Counter></Counter>
                </div>
            </Route>
            <Route path="/account/posts/">
                <div className="main-app posts">
                    <h5>Posts</h5>
                    <Posts></Posts>
                </div>
            </Route>
            <Route path="/account/image/">
                <div className="main-app imager">
                    <Imager></Imager>
                </div>
            </Route>
            <Route path="/account/table/">
                <div className="main-app table">
                    <DarkExample></DarkExample>
                </div>
            </Route>
        </>
);

};
export default App;
