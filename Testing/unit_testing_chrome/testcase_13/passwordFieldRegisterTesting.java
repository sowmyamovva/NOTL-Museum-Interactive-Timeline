package testcase_13;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class passwordFieldRegisterTesting {
    WebDriver driver = null;

    @BeforeEach
    public void beforeAll(){
        System.setProperty("webdriver.chrome.driver", "./chromedriver");
        driver = new ChromeDriver();
        driver.get("https://badger-timeline.infinityfreeapp.com/public_html/views/user/account");
    }

    @AfterEach
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
        WebElement element = driver.findElement(By.xpath("/html/body/div/div/div[2]/form/div[3]/input"));
        element.sendKeys("lebronDagoat");
    }

    public static void main (String[] args){

    }
}
