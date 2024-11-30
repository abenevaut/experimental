using UnityEngine;
using UnityEngine.UI;
using TMPro;

public class gameBoardCell : MonoBehaviour
{
    public gameBoard gBoard;

    public TMP_Text mLabel;

    public Button mButton;

    public void Fill()
    {
        mButton.interactable = false;
        mLabel.text = gBoard.GetTurnCharacter();
        gBoard.Switch();
    }
}
