package testcase_8;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class transportationSelectionTest {
    WebDriver driver = null;

    @BeforeEach
    public void beforeAll(){
        System.setProperty("webdriver.chrome.driver", "./chromedriver");
        ChromeOptions co = new ChromeOptions();
        co.addArguments("incognito");
        driver = new ChromeDriver(co);
        driver.get("https://badger-timeline.infinityfreeapp.com/src/timeline");    }

    @AfterEach
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
        WebElement element = driver.findElement(By.xpath("/html/body/div[1]/div[1]/div[1]/select"));
        Select objectSelect = new Select(element);
        objectSelect.selectByIndex(4);
    }

    public static void main (String[] args){

    }
}
